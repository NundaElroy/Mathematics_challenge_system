import java.io.Serializable;
import java.sql.*;
import java.util.Date;
import java.util.*;
import java.time.*;

public class Challenge implements Serializable {
    public String challengeId;
    private Date openDate;
    private Date closeDate;
    private int duration; // in minutes
    public String timetakenAttempting;
    private String challengeName;
    private int number_of_questions;
    public int scoreOfChallenge;
    public List<Question> questions; // holds the questions(10) for the challenge

    // will be used when attempting the challenge
    public Challenge(String challengeId, int duration, List<Question> questions) {
        this.challengeId = challengeId;
        this.duration = duration;
        this.questions = questions;
    }

    // constructor that will be used to display the available challenges
    // overloaded constructor
    public Challenge(String challengeId, Date openDate, Date closeDate, int duration,int number_of_questions, String challengeName) {
        this.challengeId = challengeId;
        this.openDate = openDate;
        this.closeDate = closeDate;
        this.duration = duration;
        this.number_of_questions = number_of_questions;
        this.challengeName = challengeName;
    }

    // public static void main(String[] args) {
    //     //fetch based on challengeid and property number of questions
    //     List<Question> questions = Question.fetchRandomQuestions(4444,10);
    //     Challenge challenge = new Challenge("4444", 2, questions);
    //     challenge.startTimedChallenge();
    //     System.out.println("Time taken: " + challenge.timetakenAttempting);
    //     System.out.println("Score: " + challenge.scoreOfChallenge);

    //     Attempt attempt = new Attempt(4444, 1, "1001",challenge.scoreOfChallenge, challenge.timetakenAttempting);
    //     // int attempt_id_generated = attempt.insertIntoDatabase();
    //     // System.out.println("Attempt ID: " + attempt_id_generated);
    //     System.out.println(attempt.toString());

    //     for (Question question : challenge.questions) {
    //         question.displayQuestionDetails();
    //         AttemptDetails attemptDetails = new AttemptDetails(1, question.getQuestionId(), 1,"4444",
    //                 question.getParticipantAnswer(),question.getCorrectAnswer(), question.getTimetaken(), question.getMarksScored());
    //                 // attemptDetails.insertIntoDatabase();
    //         System.out.println(attemptDetails.toString());
    //     }
        
    // }

    // Static method to display all valid available challenges
    public static List<Challenge> displayAvailableChallenges() {
        List<Challenge> availableChallenges = new ArrayList<>();
        try (Connection connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/mathematics_challenge", "root", "");
             Statement statement = connection.createStatement();
             ResultSet rs = statement.executeQuery("SELECT * FROM challenge WHERE CURDATE() BETWEEN opening_date AND closing_date")) {
            System.out.println("Executing query...");
            while (rs.next()) {
                String id = rs.getString("challengeid");
                Date openDate = rs.getDate("opening_date");
                Date closeDate = rs.getDate("closing_date");
                String challengeName = rs.getString("challenge_name");
                int duration = rs.getInt("duration");
                int numberOfQuestions = rs.getInt("number_of_questions");
                Challenge challenge = new Challenge(id, openDate, closeDate,  duration, numberOfQuestions,challengeName);
                availableChallenges.add(challenge);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return availableChallenges;
    }
    


    // static method to print out the challenges from a list
    public static void printOutChallenges(List<Challenge> availableChallenges) {
        // Print the header
        System.out.printf("%-20s %-25s %-20s %-20s %-20s %-15s%n", "Challenge ID", "Challenge Name", "Open Date", "Close Date", "Number of Questions", "Duration");
    
        System.out.println("".repeat(120)); // Separator line
    
        // Print each challenge in tabular format
        for (Challenge challenge : availableChallenges) {
            System.out.printf("%-20s %-25s %-20s %-20s %-20s %-15s minutes%n",
                    challenge.challengeId,
                    challenge.challengeName,
                    challenge.openDate,
                    challenge.closeDate,
                    challenge.number_of_questions,
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
        

        System.out.println("\u001B[32mEnter the correct answer for the given \noption in case you don't know, enter a minus (-) sign\u001B[0m");
        System.out.println("=".repeat(100));
        int counter = 1;

        for (Question question : questions) {
            
            question.displayQuestion(counter);
            // start time for the question
            LocalTime questionStartTime = LocalTime.now();

            String userAnswer = scanner.nextLine();
            LocalTime questionEndTime = LocalTime.now();
            Duration questionDuration = Duration.between(questionStartTime, questionEndTime);
            question.setTimetaken(questionDuration);
          
            System.out.println("_".repeat(100));
            counter++;
            totalDuration = totalDuration.plus(questionDuration);
            

            // Update remaining time and questions
            // Assuming 'duration' is in minutes and 'totalDuration' is a Duration object
            long totalSecondsLeft = duration * 60 - totalDuration.getSeconds();
            long minutesPart = totalSecondsLeft / 60;
            long secondsPart = totalSecondsLeft % 60;

            // Format the remaining time as "M:SS"
            String timeLeftFormatted = String.format("%d:%02d", minutesPart, secondsPart);

            // Example usage
            System.out.println("Time left: " + timeLeftFormatted);
            // System.out.println("Time remaining: " + minutesLeft + " minutes");
            System.out.println("Questions remaining: " + (questions.size() - counter + 1));

            // Check if the allocated duration is exceeded
            if(totalDuration.toMinutes() >= duration){
                // assign empty string  incase of a participant  answering beyond the give time
                totalDuration = Duration.ofMinutes(duration);
                question.checkAnswer("");
            
                break;
            }
            //helps handling the questions handled beyond the given time
            int mark = question.checkAnswer(userAnswer);
            totalMarks += mark;
        }

        this.timetakenAttempting = getTimetaken(totalDuration);
        this.scoreOfChallenge = totalMarks;
       
        // Stop the timer thread if the challenge finishes early
        if (timerThread.isAlive()) {
            timerThread.interrupt();
        }
        System.out.println("\u001B[1;92mCHALLENGE COMPLETED\u001B[0m");
    }

    //checks if the challenge the participant wants to answer is valid
    public static boolean isChallengeValid(int chall_id) {
        Connection conn = null;
        PreparedStatement pstmt = null;
        ResultSet rs = null;
        boolean isValid = false;
        try {
            
            Class.forName("com.mysql.jdbc.Driver");
            
            
            String url = "jdbc:mysql://localhost:3306/mathematics_challenge";
            conn = DriverManager.getConnection(url, "root", "");
            
            // Prepare the SQL statement
            String sql = "SELECT * FROM challenge WHERE challengeid = ?";
            pstmt = conn.prepareStatement(sql);
            pstmt.setInt(1, chall_id);
            
            // Execute the query
            rs = pstmt.executeQuery();
            
            // Check the result
            isValid = rs.next();
        } catch (ClassNotFoundException e) {
            System.out.println("Database driver not found.");
        } catch (SQLException e) {
            System.out.println("Database error: " + e.getMessage());
        } finally {
            // Close resources
            try {
                if (rs != null) rs.close();
                if (pstmt != null) pstmt.close();
                if (conn != null) conn.close();
            } catch (SQLException e) {
                System.out.println("Error closing resources: " + e.getMessage());
            }
        }
        return isValid;
    }
  //method to fetch challenge by id
    public static int getDurationByChallengeId(int challengeId) {
        String url = "jdbc:mysql://localhost:3306/mathematics_challenge";
        try (Connection conn = DriverManager.getConnection(url, "root", "");
             PreparedStatement pstmt = conn.prepareStatement("SELECT duration FROM challenge WHERE challengeid = ?")) {
            
            pstmt.setInt(1, challengeId);
            
            try (ResultSet rs = pstmt.executeQuery()) {
                if (rs.next()) {
                    return rs.getInt("duration");
                } else {
                    return -1; // Challenge ID not found
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
            return -1;
        }
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

    public static int getNumberOfQuestionForChallenge(String challengeid){
        Connection conn = null;
        PreparedStatement pstmt = null;
        ResultSet rs = null;
        int no_of_questions = -1;
        try {
            
            Class.forName("com.mysql.jdbc.Driver");
            
            
            String url = "jdbc:mysql://localhost:3306/mathematics_challenge";
            conn = DriverManager.getConnection(url, "root", "");
            
            // Prepare the SQL statement
            String sql = "SELECT number_of_questions FROM challenge WHERE challengeid = ?";
            pstmt = conn.prepareStatement(sql);
            pstmt.setString(1, challengeid);
            
            // Execute the query
            rs = pstmt.executeQuery();
            while(rs.next()){
                no_of_questions = rs.getInt("number_of_questions");
            }

        } catch (ClassNotFoundException e) {
            System.out.println("Database driver not found.");
        } catch (SQLException e) {
            System.out.println("Database error: " + e.getMessage());
        } finally {
            // Close resources
            try {
                if (rs != null) rs.close();
                if (pstmt != null) pstmt.close();
                if (conn != null) conn.close();
            } catch (SQLException e) {
                System.out.println("Error closing resources: " + e.getMessage());
            }
        }
       return no_of_questions;
    }

    private int calculateTotalScore() {
        return this.scoreOfChallenge; // Modify this method if you have more complex scoring logic
    }
}
