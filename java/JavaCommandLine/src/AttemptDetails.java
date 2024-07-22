import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;

public class AttemptDetails {

    private int attemptId;
    private int questionId;
    private int participantId;
    private String challengeId;
    private String selectedAnswer;
    private String correctAnswer;
    private String Timetaken ;
    private int score;

    public AttemptDetails(int attemptId ,int questionId,int participantId,String challengeId ,String selectedAnswer,String correctAnswer,String Timetaken, int score) {
        
        this.attemptId = attemptId;
        this.questionId = questionId;
        this.participantId = participantId;
        this.challengeId = challengeId;
        this.selectedAnswer = selectedAnswer;
        this.correctAnswer = correctAnswer;
        this.Timetaken = Timetaken;
        this.score = score;
    }

   

    //method to insert into the database
    public void insertIntoDatabase() {
        // Database URL
        String url = "jdbc:mysql://localhost:3306/mathematics_challenge"; 
        // Database credentials
        String user = "root";
        String password = "";

        // SQL INSERT statement
        String sql = "INSERT INTO attempt_details ( attemptid, questionid,participantid, challengeId,selected_answer,correct_answer,timetaken_per_question, score) VALUES ( ?,?,?,?,?,?,?,?)";

        // Try-with-resources statement to ensure that resources are closed
        try (Connection conn = DriverManager.getConnection(url, user, password);
             PreparedStatement pstmt = conn.prepareStatement(sql)) {

            // Set parameters for the INSERT statement
            
            pstmt.setInt(1, this.attemptId);
            pstmt.setInt(2, this.questionId);
            pstmt.setInt(3, this.participantId);
            pstmt.setString(4, this.challengeId);
            pstmt.setString(5, this.selectedAnswer);
            pstmt.setString(6, this.correctAnswer);
            pstmt.setString(7, this.Timetaken);
            pstmt.setInt(8, this.score);
             // Execute the INSERT operation
            int rowsAffected = pstmt.executeUpdate();
            System.out.println(rowsAffected + " row(s) inserted into the database.");
        } catch (SQLException e) {
            System.out.println("Error inserting data into the database: " + e.getMessage());
        }
    }



    // Getters and Setters
   
    public int getAttemptId() {
        return attemptId;
    }

    public void setAttemptId(int attemptId) {
        this.attemptId = attemptId;
    }

    public int getQuestionId() {
        return questionId;
    }

    public void setQuestionId(int questionId) {
        this.questionId = questionId;
    }

    public String getSelectedAnswer() {
        return selectedAnswer;
    }

    public void setSelectedAnswer(String selectedAnswer) {
        this.selectedAnswer = selectedAnswer;
    }

    public String getCorrectAnswer() {
        return correctAnswer;
    }

    public void setCorrectAnswer(String correctAnswer) {
        this.correctAnswer = correctAnswer;
    }

    public int getScore() {
        return score;
    }

    public void setScore(int score) {
        this.score = score;
    }
    @Override
    public String toString() {
        return "AttemptDetails{" +
            "attemptId=" + attemptId +
            ", questionId=" + questionId +
            ", participantId=" + participantId +
            ", challengeId=" + challengeId +
            ", selectedAnswer='" + selectedAnswer + '\'' +
            ", correctAnswer='" + correctAnswer + '\'' +
            ", Timetaken='" + Timetaken + '\'' +
            ", score=" + score +
            '}';
    }

    
}