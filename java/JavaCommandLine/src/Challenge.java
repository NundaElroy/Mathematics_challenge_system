import java.io.Serializable;
import java.sql.*;
import java.util.Date;
import java.util.*;





public class Challenge implements Serializable {
    private int challengeId;
    private Date openDate;
    private Date closeDate;
    private int duration;
    private int scoreOfChallenge;                      
    private List<Question> questions;//holds the questions(10) for the challenge
    

    //will be used when attempting the challenge
    public Challenge(int challengeId,  int duration, List<Question> questions) {
        this.challengeId = challengeId;
        this.duration = duration;
        this.questions = questions;
        
    }
    
    //constructor that will be used to display the available challenges
    //overloaded constructor
    public Challenge(int challengeId, Date openDate, Date closeDate, int duration) {
        this.challengeId = challengeId;
        this.openDate = openDate;
        this.closeDate = closeDate;
        this.duration = duration;
    }
    public static void main(String[] args) {

       List<Question> questions = Question.fetchRandomQuestions();
    
    Date openDate = new Date();
    Date closeDate = new Date();
    
    Challenge challenge = new Challenge(4444, 40, questions);
    challenge.startChallenge();
    challenge.getScore();
        
    }
     // Static method to display all valid available challenges
     public static List<Challenge> displayAvailableChallenges() {
        List<Challenge> availableChallenges = new ArrayList<>();
        try (Connection connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/dummy_database", "root", "");
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
//static method to print out the challenges from a list
  public static void printOutChallenges(List<Challenge> availableChallenges) {
    for (Challenge challenge : availableChallenges) {
        System.out.println("_".repeat(50));
        System.out.println("Challenge ID: " + challenge.challengeId);
        System.out.println("Open Date: " + challenge.openDate);
        System.out.println("Close Date: " + challenge.closeDate);
        System.out.println("Duration: " + challenge.duration + "minutes");
        System.out.println("_".repeat(50));
    }

  }
//method for printing out questions in challenge
public void startChallenge() {
    Scanner scanner = new Scanner(System.in);
    int totalMarks = 0;
    System.out.println("Enter your the correct answer for the given \n option incase you dont know enter a minus(-) sign ");
    System.out.println("=".repeat(100));
    int counter = 1;
    for (Question question : questions) {
        question.displayQuestion(counter);
        //start time
        long startTime = System.currentTimeMillis();

        String userAnswer = scanner.nextLine();
        long endTime = System.currentTimeMillis();
        long duration = endTime - startTime;
        double durationSeconds = duration / 1000.0;
        question.setTimetaken(durationSeconds);
        int mark = question.checkAnswer(userAnswer);
        System.out.println("_".repeat(100));
        counter++;
        totalMarks += mark;
    }
    
    this.scoreOfChallenge = totalMarks;
    // Here, you could pass totalMarks to another class instance as needed.
}
public void getScore(){
    System.out.println(this.scoreOfChallenge);
}

 
}

