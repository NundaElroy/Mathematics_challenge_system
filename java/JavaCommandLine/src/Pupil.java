import java.awt.image.*;
import java.io.*;
import javax.imageio.ImageIO;
import java.sql.*;

public class Pupil  {
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
    public static void main(String[] args) {
        // Pupil pupil1 = new Pupil("24/U/1582", "jdoe", "John", "Doe", "johndoe@example.com", "2003-05-21", "C:/Users/jdoe/OneDrive/Desktop/JavaCommandLine/src/student1.JPG");
        // Pupil pupil2 = new Pupil("25/U/1743", "asmith", "ASpassword123", "Anna", "Smith", "annasmith@example.com", "2004-08-15", "C:/Users/asmith/OneDrive/Desktop/JavaCommandLine/src/student2.JPG");
        // Pupil pupil3 = new Pupil("26/U/1829", "mbrown", "MBpassword123", "Michael", "Brown", "michaelbrown@example.com", "2001-12-09", "C:/Users/mbrown/OneDrive/Desktop/JavaCommandLine/src/student3.JPG");
        // Pupil pupil4 = new Pupil("27/U/1930", "ljohnson", "LJpassword123", "Linda", "Johnson", "lindajohnson@example.com", "2002-03-26", "C:/Users/ljohnson/OneDrive/Desktop/JavaCommandLine/src/student4.JPG");
        
        
        
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

//override of the toString method
public String toString(){
    return "Registration Number: " + RegistrationNumber + "\n" + "UserName: " + UserName  + "FirstName: " + FirstName + "\n" + "LastName: " + LastName + "\n" + "EmailAddress: " + EmailAddress + "\n" + "DateOfBirth: " + DateOfBirth + "\n" + "Status: " + Status + "\n" + "Photo: " + FilePathOfImage + "\n";
}
}