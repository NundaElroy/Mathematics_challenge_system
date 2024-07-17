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

        // Attempt attempt = new Attempt(challenge.challengeId, 1, challenge.scoreOfChallenge, challenge.timetakenAttempting);
        // int attempt_id_generated = attempt.insertIntoDatabase();
        // System.out.println("Attempt ID: " + attempt_id_generated);

        // for (Question question : challenge.questions) {
        //     AttemptDetails attemptDetails = new AttemptDetails(attempt_id_generated, question.getQuestionId(), 1,
        //             question.getParticipantAnswer(), question.getTimetaken(), question.getMarksScored());
        //     attemptDetails.insertIntoDatabase();
        // }
    }

    // Static method to display all valid available challenges
    public static List<Challenge> displayAvailableChallenges() {
        List<Challenge> availableChallenges = new ArrayList<>();
        try (Connection connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/mathematics_challenge", "root", "");
             Statement statement = connection.createStatement();
             ResultSet rs = statement.executeQuery("SELECT * FROM challenge WHERE CURDATE() BETWEEN opening_date AND closing_date")) {
            System.out.println("Executing query...");
            while (rs.next()) {
                int id = rs.getInt("id");
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
    public static void printOutChallenges(List<Challenge> availableChallenges) {
        for (Challenge challenge : availableChallenges) {
            System.out.println("_".repeat(50));
            System.out.println("Challenge ID: " + challenge.challengeId);
            System.out.println("Open Date: " + challenge.openDate);
            System.out.println("Close Date: " + challenge.closeDate);
            System.out.println("Duration: " + challenge.duration + " minutes");
            System.out.println("_".repeat(50));
        }
    }

    // method for printing out questions in challenge
    public void startTimedChallenge() {
        //anonymous class with implicit implementation of the anonymous interface
        Thread timerThread = new Thread(new Runnable() {
            public void run() {
                try {
                    Thread.sleep(duration * 60 * 1000);
                    System.out.println("Time is up! Challenge has ended.");
                    
                } catch (InterruptedException e) {
                    // Challenge ended early
                    e.printStackTrace();
                }
            }
        });

        timerThread.start();
        startChallenge(timerThread);
    }
    public void startChallenge(Thread timerThread) {
        int totalMarks = 0;
        Duration totalDuration = Duration.ZERO;

        System.out.println("Enter the correct answer for the given \n option in case you don't know, enter a minus (-) sign.");
        System.out.println("=".repeat(100));
        int counter = 1;

        for (Question question : questions) {
            if (!timerThread.isAlive()) {
                System.out.println("Challenge has been interrupted.");
                break;
            }

            question.displayQuestion(counter);

            LocalTime questionStartTime = LocalTime.now();
            InputRead inputReader = new InputRead();

            while (!inputReader.isInterrupted() && inputReader.getInput() == null) {
                try {
                    Thread.sleep(100); // Small sleep to allow interrupt to be caught
                } catch (InterruptedException e) {
                    System.out.println("Input interrupted.");
                    break;
                }
            }

            if (inputReader.isInterrupted() || !timerThread.isAlive()) {
                System.out.println("Challenge has been interrupted.");
                break;
            }

            String userAnswer = inputReader.getInput();
            LocalTime questionEndTime = LocalTime.now();
            Duration questionDuration = Duration.between(questionStartTime, questionEndTime);
            question.setTimetaken(questionDuration);
            int mark = question.checkAnswer(userAnswer);
            System.out.println("_".repeat(100));
            counter++;
            totalDuration = totalDuration.plus(questionDuration);
            totalMarks += mark;

            long minutesLeft = duration - totalDuration.toMinutes();
            System.out.println("Time remaining: " + minutesLeft + " minutes");
            System.out.println("Questions remaining: " + (questions.size() - counter + 1));
        }

        this.timetakenAttempting = getTimetaken(totalDuration);
        this.scoreOfChallenge = totalMarks;

        if (timerThread.isAlive()) {
            timerThread.interrupt();
        }
    }


    // private void endChallengeEarly() {
    //     this.timetakenAttempting = getTimetaken(Duration.ofMinutes(duration));
    //     this.scoreOfChallenge = calculateTotalScore();
    // }

    // public void startChallenge(Thread timerThread) {
    //     Scanner scanner = new Scanner(System.in);
    //     int totalMarks = 0;
    //     Duration totalDuration = Duration.ZERO;
    //     LocalDateTime startTime = LocalDateTime.now();

    //     System.out.println("Enter the correct answer for the given \n option in case you don't know, enter a minus (-) sign.");
    //     System.out.println("=".repeat(100));
    //     int counter = 1;

    //     for (Question question : questions) {
    //     //     if ( Thread.interrupted()) {
               
    //     //         // Interrupt the timer thread if not already interrupted
    //     //        break; // Exit the loop immediately
    //     //    }
    //         question.displayQuestion(counter);
    //         // start time for the question
    //         LocalTime questionStartTime = LocalTime.now();

    //         String userAnswer = scanner.nextLine();
    //         LocalTime questionEndTime = LocalTime.now();
    //         Duration questionDuration = Duration.between(questionStartTime, questionEndTime);
    //         question.setTimetaken(questionDuration);
    //         int mark = question.checkAnswer(userAnswer);
    //         System.out.println("_".repeat(100));
    //         counter++;
    //         totalDuration = totalDuration.plus(questionDuration);
    //         totalMarks += mark;

    //         // Update remaining time and questions
    //         long minutesLeft = duration - totalDuration.toMinutes();
    //         System.out.println("Time remaining: " + minutesLeft + " minutes");
    //         System.out.println("Questions remaining: " + (questions.size() - counter + 1));

    //         // Check if the allocated duration is exceeded
    //         if ( Thread.interrupted()) {
               
    //              // Interrupt the timer thread if not already interrupted
    //             break; // Exit the loop immediately
    //         }
    //     }

    //     this.timetakenAttempting = getTimetaken(totalDuration);
    //     this.scoreOfChallenge = totalMarks;

    //     // Stop the timer thread if the challenge finishes early
    //     if (timerThread.isAlive()) {
    //         timerThread.interrupt();
    //     }
    // }

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
