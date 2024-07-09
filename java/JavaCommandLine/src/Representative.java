import java.sql.*;
import java.io.*;
public class Representative implements Serializable{
   private  String RepresentativeName;
   private String email;

    public Representative(String RepresentativeName, String email) {
        this.RepresentativeName = RepresentativeName;
        this.email = email;
    }
   

    public static void main(String[] args) {
         Representative rep = new Representative("John Dye", "johndoe@example.com");
        // if(rep.login()){
        //     System.out.println("user exists or loggin successful");
        // }else{
        //     System.out.println("loggin failed/user does not exist");
        // }
        
        
        
    }
    //verification of details of representative during logging
    public boolean login() {
        String databaseURL = "jdbc:mysql://localhost:3306/dummy_database";
        Connection connection = null; 
        Statement statement = null;
        ResultSet result = null; 
        PreparedStatement preparedStatement = null; 
        boolean IsValid = false;
        try {
            connection = DriverManager.getConnection(databaseURL, "root", "");
            statement = connection.createStatement();
            preparedStatement = connection.prepareStatement("SELECT EXISTS (SELECT 1 FROM representative WHERE representative_name = ? AND representative_email = ?) AS user_exists");
            preparedStatement.setString(1, RepresentativeName); // 1st question mark will be replaced by "representative_name"
            preparedStatement.setString(2, email); // 2nd question mark will be replaced by "email"
            result = preparedStatement.executeQuery();
            
            //check if the user exists 
            if (result.next()) {
                IsValid = result.getBoolean("user_exists");
            }
            
        } catch (SQLException ex) {
            System.out.println("An error occurred. Maybe user/password is invalid");
            ex.printStackTrace();

        
        }finally {
            try {
                if (connection != null) {
                    connection.close();
                    result.close();
                    statement.close();
                    preparedStatement.close();
                    
                }
            } catch (SQLException ex) {
                ex.printStackTrace();
            }
        }
        return IsValid; //returns false if user does exist and true otherwise
    }
 
   
    
    

    public void setEmail(String email) {
        this.email = email;
    }

    public String getEmail() {
        return email;
    }

    public String getRepresentativeName() {
        return RepresentativeName;
    }
    public void setRepresentativeName(String RepresentativeName) {
        this.RepresentativeName = RepresentativeName;
    }
}
