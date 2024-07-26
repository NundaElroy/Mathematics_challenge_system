
import java.util.Date;
import java.text.SimpleDateFormat;
import java.sql.*;
public class Attempt {
    private int challengeid;
    private int  participantid;
    private  String schoolid;
    private int score;
    private String attemptDate;
    private String timetaken;
    public Attempt(int challengeid,int participantid,String schoolid,int score,   String time){
        this.challengeid = challengeid;
        this.participantid = participantid;
        this.schoolid = schoolid;
        this.score = score;
        this.attemptDate = getCurrentDate();
        this.timetaken = time;
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
    String url = "jdbc:mysql://localhost:3306/mathematics_challenge";
    String user = "root";
    String password = "";

    // SQL query to insert data into the attempts table
    String sql = "INSERT INTO attempts (challengeId, participantid, school_registration_no,score, attempt_date, timetaken) VALUES (?,?, ?, ?, ?, ?)";

    int generatedAttemptId = -1; // Variable to store the generated attemptid

    try (Connection conn = DriverManager.getConnection(url, user, password);
         PreparedStatement pstmt = conn.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
        
        // Set parameters for the insert statement
        pstmt.setInt(1, this.challengeid);
        pstmt.setInt(2, this.participantid);
         pstmt.setString(3, this.schoolid);
        pstmt.setInt(4, this.score);
        pstmt.setString(5, this.attemptDate);
        pstmt.setString(6, this.timetaken);

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
public static  boolean checkForNumberForNoPerChallenge(int participantId, String challengeId) {
    String query = "SELECT COUNT(*) AS attempt_count FROM attempts WHERE participantid = ? AND challengeId = ?";
    int count =0 ;
    try (Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/mathematics_challenge", "root", "");
         PreparedStatement pstmt = conn.prepareStatement(query)) {
        
        pstmt.setInt(1, participantId);
        pstmt.setString(2, challengeId);
        
        try (ResultSet rs = pstmt.executeQuery()) {
            if (rs.next()) {
                count = rs.getInt("attempt_count");
                
            }
        }
    } catch (SQLException e) {
        e.printStackTrace();
    }
    if (count < 3){
        return true;
    }else {
        return false;
    }
    
     // Default to false if there's an error
}
@Override
public String toString() {
    return "Attempt{" +
           "challengeid=" + challengeid +
           ", participantid=" + participantid +
           ", score=" + score +
           ", attemptDate='" + attemptDate + '\'' +
           ", timetaken='" + timetaken + '\'' +
           '}';
}

}
