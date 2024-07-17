import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;

public class AttemptDetails {

    private int attemptId;
    private int questionId;
    private int participantId;
    private String selectedAnswer;
    private String correctAnswer;
    private String Timetaken ;
    private int score;

    public AttemptDetails(int attemptId ,int questionId,int participantId, String selectedAnswer,String Timetaken, int score) {
        
        this.attemptId = attemptId;
        this.questionId = questionId;
        this.participantId = participantId;
        this.selectedAnswer = selectedAnswer;
        this.Timetaken = Timetaken;
        this.score = score;
    }

    //method to insert into the database
    public void insertIntoDatabase() {
        // Database URL
        String url = "jdbc:mysql://localhost:3306/dummy_database"; // Adjust for your database (e.g., MySQL, PostgreSQL)
        // Database credentials
        String user = "root";
        String password = "";

        // SQL INSERT statement
        String sql = "INSERT INTO attempt_details ( attemptid, questionid,participantid, selected_answer,timetaken, score) VALUES ( ?,?,?,?,?,?)";

        // Try-with-resources statement to ensure that resources are closed
        try (Connection conn = DriverManager.getConnection(url, user, password);
             PreparedStatement pstmt = conn.prepareStatement(sql)) {

            // Set parameters for the INSERT statement
            
            pstmt.setInt(1, this.attemptId);
            pstmt.setInt(2, this.questionId);
            pstmt.setInt(3, this.participantId);
            pstmt.setString(4, this.selectedAnswer);
            pstmt.setString(5, this.Timetaken);
            pstmt.setInt(6, this.score);
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

    
}