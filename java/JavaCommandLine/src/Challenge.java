import java.io.Serializable;
import java.sql.*;
import java.util.Date;
import java.util.*;
import java.time.*;

public class Challenge implements Serializable {
    private int challengeId;
    private Date openDate;
    private Date closeDate;
    private int duration; // in minutes
    private String timetakenAttempting;
    private int scoreOfChallenge;
    private List<Question> questions; // holds the questions(10) for the challenge

    // will be used when attempting the challenge
    public Challenge(int challengeId, int duration, List<Question> questions) {
        this.challengeId = challengeId;
        this.duration = duration;
        this.questions = questions;
    }

    // constructor that will be used to display the available challenges
    // overloaded constructor
    public Challenge(int challengeId, Date openDate, Date closeDate, int duration) {
        this.challengeId = challengeId;
        this.openDate = openDate;
        this.closeDate = closeDate;
        this.duration = duration;
    }

    public static void main(String[] args) {
        List<Question> questions = Question.fetchRandomQuestions();
        Challenge challenge = new Challenge(4444, 1, questions);
        challenge.startTimedChallenge();
        System.out.println("Time taken: " + challenge.timetakenAttempting);
        System.out.println("Score: " + challenge.scoreOfChallenge);

        Attempt attempt = new Attempt(challenge.challengeId, 1, challenge.scoreOfChallenge, challenge.timetakenAttempting);
        int attempt_id_generated = attempt.insertIntoDatabase();
        System.out.println("Attempt ID: " + attempt_id_generated);

        for (Question question : challenge.questions) {
            AttemptDetails attemptDetails = new AttemptDetails(attempt_id_generated, question.getQuestionId(), 1,
                    question.getParticipantAnswer(), question.getTimetaken(), question.getMarksScored());
            attemptDetails.insertIntoDatabase();
        }
    }

    // Static method to display all valid available challenges
    public static List<Challenge> displayAvailableChallenges() {
        List<Challenge> availableChallenges = new ArrayList<>();
        try (Connection connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/mathematics_challenge_db", "root", "");
             Statement statement = connection.createStatement();
             ResultSet rs = statement.executeQuery("SELECT * FROM challenge WHERE CURDATE() BETWEEN opening_date AND closing_date")) {
            System.out.println("Executing query...");
            while (rs.next()) {
                int id = rs.getInt("challengeid");
                Date openDate = rs.getDate("opening_date");
                Date closeDate = rs.getDate("closing_date");
                int duration = rs.getInt("duration");
                Challenge challenge = new Challenge(id, openDate, closeDate, duration);
                availableChallenges.add(challenge);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return availableChallenges;
    }

    // static method to print out the challenges from a list
    // static method to print out the challenges from a list
    public static void printOutChallenges(List<Challenge> availableChallenges) {
        // Print the header
        System.out.printf("%-20s %-20s %-20s %-20s%n", "Challenge ID", "Open Date", "Close Date", "Duration");
        System.out.println("".repeat(80)); // Separator line
    
        // Print each challenge in tabular format
        for (Challenge challenge : availableChallenges) {
            System.out.printf("%-20s %-20s %-20s %-20s minutes%n",
                    challenge.challengeId,
                    challenge.openDate,
                    challenge.closeDate,
                    challenge.duration);
        }
    }

    // method for printing out questions in challenge
    public void startTimedChallenge() {
        Thread timerThread = new Thread(new Runnable() {
            public void run() {
                try {
                    Thread.sleep(duration * 60 * 1000);
                    System.out.println("\u001B[31mTime is up! Challenge has ended.\u001B[0m");
                    System.out.println("\u001B[32mPress enter to continue...\u001B[0m");
        
                } catch (InterruptedException e) {
                    // Challenge ended early
                }
            }
        });

        timerThread.start();
        startChallenge(timerThread);
    }

    

    public void startChallenge(Thread timerThread) {
        Scanner scanner = new Scanner(System.in);
        int totalMarks = 0;
        Duration totalDuration = Duration.ZERO;
        LocalDateTime startTime = LocalDateTime.now();

        System.out.println("\u001B[32mEnter the correct answer for the given \noption in case you don't know, enter a minus (-) sign\u001B[0m");
        System.out.println("=".repeat(100));
        int counter = 1;

        for (Question question : questions) {
            // if(totalDuration.toMinutes() >= duration ){
            //     System.out.println("\u001B[31mTime is up! Challenge has ended.\u001B[0m");
            //     System.out.println("\u001B[32mPress enter to continue...\u001B[0m");
            //     break;
            // }
            question.displayQuestion(counter);
            // start time for the question
            LocalTime questionStartTime = LocalTime.now();

            String userAnswer = scanner.nextLine();
            LocalTime questionEndTime = LocalTime.now();
            Duration questionDuration = Duration.between(questionStartTime, questionEndTime);
            question.setTimetaken(questionDuration);
            int mark = question.checkAnswer(userAnswer);
            System.out.println("_".repeat(100));
            counter++;
            totalDuration = totalDuration.plus(questionDuration);
            totalMarks += mark;

            // Update remaining time and questions
            long minutesLeft = duration - totalDuration.toMinutes();
            System.out.println("Time remaining: " + minutesLeft + " minutes");
            System.out.println("Questions remaining: " + (questions.size() - counter + 1));

            // Check if the allocated duration is exceeded
            if(totalDuration.toMinutes() >= duration){
                totalDuration = Duration.ofMinutes(duration);
                // System.out.println("\u001B[31mTime is up! Challenge has ended.\u001B[0m");
                // System.out.println("\u001B[32mPress enter to continue...\u001B[0m");
                break;
            }
            
        }

        this.timetakenAttempting = getTimetaken(totalDuration);
        this.scoreOfChallenge = totalMarks;
       
        // Stop the timer thread if the challenge finishes early
        if (timerThread.isAlive()) {
            timerThread.interrupt();
        }
        System.out.println("\u001B[1;92mCHALLENGE COMPLETED\u001B[0m");
    }

    public void getScore() {
        System.out.println(this.scoreOfChallenge);
    }

    // total time taken attempting the challenge in a desirable format
    public static String getTimetaken(Duration duration) {
        long hours = duration.toHours();
        long minutes = duration.toMinutes() % 60;
        long seconds = duration.getSeconds() % 60;
        return String.format("%02d:%02d:%02d", hours, minutes, seconds);
    }

    private int calculateTotalScore() {
        return this.scoreOfChallenge; // Modify this method if you have more complex scoring logic
    }
}
