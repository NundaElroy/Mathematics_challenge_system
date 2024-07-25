import java.awt.image.*;
import java.io.*;
import javax.imageio.ImageIO;
import java.sql.*;

public class Pupil  {
  private int participantid;
  private String RegistrationNumber;
  private String UserName;
  private String FirstName;
  private String LastName;
  private String EmailAddress;
  private String DateOfBirth;
  private String FilePathOfImage;  //file path of the profile image
  private boolean Status = false;//True for accepted and false rejected but default is false 

    public Pupil(String RegistrationNumber, String UserName,  String FirstName, String LastName, String EmailAddress, String DateOfBirth,   String FilePathOfImage) {
        this.RegistrationNumber = RegistrationNumber;
        this.UserName = UserName;
        this.FirstName = FirstName;
        this.LastName = LastName;
        this.EmailAddress = EmailAddress;
        this.DateOfBirth = DateOfBirth;
        this.FilePathOfImage = manageFilePath(FilePathOfImage);
    }
    //overload of constructor
    public Pupil (int participantId,String school_registration_no){
        this.participantid = participantId;
        this.RegistrationNumber = school_registration_no;
    }

   //registers the accepted pupils on the database  and rejected pupils into the database  
   public  void registerPupil() {
    String databaseURL = "jdbc:mysql://localhost:3306/mathematics_challenge";
    Connection connection = null;
    PreparedStatement preparedStatement = null;

    try {
        connection = DriverManager.getConnection(databaseURL, "root", "");
        //checks whether the status is true to participant or false sent to rejected
        String tableName = Status ? "participants" : "rejected";
        //sql statement for insertion 
        String sql = "INSERT INTO " + tableName + " (school_registration_no, username, firstname, lastname, email, DOB, image) VALUES (?, ?, ?, ?, ?, ?, ?)";

        preparedStatement = connection.prepareStatement(sql);
        preparedStatement.setString(1, RegistrationNumber);
        preparedStatement.setString(2, UserName);
        preparedStatement.setString(3, FirstName);
        preparedStatement.setString(4, LastName);
        preparedStatement.setString(5, EmailAddress);
        preparedStatement.setString(6, DateOfBirth);

        // Load the image file into a byte array
        byte[] imageBytes = loadImage(FilePathOfImage);
        if (imageBytes != null) {
            preparedStatement.setBytes(7, imageBytes);
        } else {
            preparedStatement.setNull(7, java.sql.Types.BLOB);
        }

        // Execute the update
        preparedStatement.executeUpdate();
        System.out.println("Pupil data added to " + tableName + " table.");

    } catch (SQLException ex) {
        System.out.println("An error occurred.");
        ex.printStackTrace();
    } finally {
        try {
            if (preparedStatement != null) {
                preparedStatement.close();
            }
            if (connection != null) {
                connection.close();
            }
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
    }
}

//login credentials for a pupil 
public static  boolean login(String username, String email) {
    String databaseURL = "jdbc:mysql://localhost:3306/mathematics_challenge";
    Connection connection = null;
    PreparedStatement preparedStatement = null;
    ResultSet resultSet = null;
    boolean loginSuccess = false;

    try {
        connection = DriverManager.getConnection(databaseURL, "root", "");
        String sql = "SELECT * FROM participants WHERE username = ? AND email = ?";
        preparedStatement = connection.prepareStatement(sql);
        preparedStatement.setString(1, username);
        preparedStatement.setString(2, email);

        resultSet = preparedStatement.executeQuery();
        // If resultSet has at least one row, the login is successful
        loginSuccess = resultSet.next();
    } catch (SQLException ex) {
        System.out.println("Login failed: An error occurred.");
        ex.printStackTrace();
    } finally {
        try {
            if (resultSet != null) resultSet.close();
            if (preparedStatement != null) preparedStatement.close();
            if (connection != null) connection.close();
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
    }

    return loginSuccess;
}

public void setStatus(boolean status){
    this.Status = status; //it can true false in case they have rejected
}

private static String manageFilePath(String jpeg){
    return "C:\\Users\\Alvin\\OneDrive\\Desktop\\photos\\" + jpeg;
}




//method to load image
private static byte [] loadImage(String FilePathOfImage){
    BufferedImage imageOfStudent = null;
    int width = 414;
    int height = 531;
    try{
        File imagefile = new File(FilePathOfImage);
        imageOfStudent = new BufferedImage(width, height, BufferedImage.TYPE_INT_ARGB);
        imageOfStudent = ImageIO.read(imagefile);
        System.out.println("image loaded");
        if(imageOfStudent != null){
            
            ByteArrayOutputStream baos = new ByteArrayOutputStream();
            ImageIO.write(imageOfStudent, "png", baos);
            return baos.toByteArray();
            
        }
        else{
            System.out.println("image not loaded");
        }
        
      
    }catch(IOException e){
        e.printStackTrace();
    }
    
    return null; // Add this line to return a default value if no other return statement is reached
}


//method returns the participant id for a given user
public static Pupil getParticipantIdAndSchoolRegNoByUsername(String username) {
    int participantId = -1; // Default or error value
    String school_registration_no = "";
    String url = "jdbc:mysql://localhost:3306/mathematics_challenge"; 
    String dbUsername = "root"; 
    String password = ""; // Update with the actual password

    String query = "SELECT participantid,school_registration_no FROM participants WHERE username = ?";

    try (Connection conn = DriverManager.getConnection(url, dbUsername, password);
         PreparedStatement pstmt = conn.prepareStatement(query)) {
        
        pstmt.setString(1, username); // Set the username parameter
        
        try (ResultSet rs = pstmt.executeQuery()) {
            if (rs.next()) {
                participantId = rs.getInt("participantid");
                school_registration_no = rs.getString("school_registration_no");
            }
        }
    } catch (SQLException e) {
        e.printStackTrace();
    }
    return new Pupil(participantId, school_registration_no);
}

//checking second time registration
public static boolean checkIfParticipantHasBeenRejectedBefore(String participantUsername) {
    String url = "jdbc:mysql://localhost:3306/mathematics_challenge"; // Adjust the URL as needed
    String user = "root";
    String password = ""; // Replace with your actual password

    String query = "SELECT 1 FROM rejected WHERE username = ?";

    try (Connection connection = DriverManager.getConnection(url, user, password);
         PreparedStatement preparedStatement = connection.prepareStatement(query)) {

        preparedStatement.setString(1, participantUsername);

        try (ResultSet resultSet = preparedStatement.executeQuery()) {
            return resultSet.next(); // If a row is found, return true
        }

    } catch (SQLException e) {
        e.printStackTrace();
        // Handle exceptions appropriately in your actual code
    }

    return false; // Return false if no row is found or an exception occurs
}

public boolean getStatus(){
    return Status;
}
//override of the toString method
public String toString(){
    return "Registration Number: " + RegistrationNumber + "\n" + "UserName: " + UserName  + "FirstName: " + FirstName + "\n" + "LastName: " + LastName + "\n" + "EmailAddress: " + EmailAddress + "\n" + "DateOfBirth: " + DateOfBirth + "\n" + "Status: " + Status + "\n" + "Photo: " + FilePathOfImage + "\n";
}

public String getSchoolRegno(){
    return this.RegistrationNumber;
}
public int getParticipantId(){
    return this.participantid;
}

}