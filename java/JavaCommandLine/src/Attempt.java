
import java.util.Date;
import java.text.SimpleDateFormat;
import java.sql.*;
public class Attempt {
    private int challengeid;
    private int  participantid;
    private int score;
    private String attemptDate;
    private String timetaken;
    public Attempt(int challengeid,int participantid,int score,   String time){
        this.challengeid = challengeid;
        this.participantid = participantid;
        this.score = score;
        this.attemptDate = getCurrentDate();
        this.timetaken = time;
    }
    public static void main(String[] args) {
        System.out.println(getCurrentDate());
    }


    //method to get current date 
   public static String getCurrentDate() {
    // Create a date object representing the current date and time
    Date currentDate = new Date();
    // Use SimpleDateFormat to format the date in the form yyyy-MM-dd
    SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
    // Return the formatted date string
    return dateFormat.format(currentDate);
}

//method to insert data into the database 
public int insertIntoDatabase() {
    // Database connection details
    String url = "jdbc:mysql://localhost:3306/dummy_database";
    String user = "root";
    String password = "";

    // SQL query to insert data into the attempts table
    String sql = "INSERT INTO attempts (challengeid, participantid, score, attempt_date, timetaken) VALUES (?, ?, ?, ?, ?)";

    int generatedAttemptId = -1; // Variable to store the generated attemptid

    try (Connection conn = DriverManager.getConnection(url, user, password);
         PreparedStatement pstmt = conn.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
        
        // Set parameters for the insert statement
        pstmt.setInt(1, this.challengeid);
        pstmt.setInt(2, this.participantid);
        pstmt.setInt(3, this.score);
        pstmt.setString(4, this.attemptDate);
        pstmt.setString(5, this.timetaken);

        // Execute the insert operation
        pstmt.executeUpdate();

        // Retrieve the generated keys (auto-incremented ID)
        try (ResultSet generatedKeys = pstmt.getGeneratedKeys()) {
            if (generatedKeys.next()) {
                generatedAttemptId = generatedKeys.getInt(1); // Get the generated attemptid
            } else {
                throw new SQLException("Creating attempt failed, no ID obtained.");
            }
        }
    } catch (SQLException e) {
        System.out.println("Error inserting data into the database: " + e.getMessage());
    }

    return generatedAttemptId; // Return the generated attemptid
}
}
