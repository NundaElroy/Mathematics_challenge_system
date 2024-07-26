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
         Representative rep = new Representative("John Doe", "johndoe@example.com");
        // if(rep.login()){
        //     System.out.println("user exists or loggin successful");
        // }else{
        //     System.out.println("loggin failed/user does not exist");
        // }
        
        
        
    }
    //verification of details of representative during logging
    public boolean login() {
        String databaseURL = "jdbc:mysql://localhost:3306/mathematics_challenge";
        Connection connection = null;
        ResultSet result = null;
        PreparedStatement preparedStatement = null;
        boolean IsValid = false;
        try {
            connection = DriverManager.getConnection(databaseURL, "root", "");
            // Adjusted the table name to `schools` and column names to `representative_name` and `representative_email`
            preparedStatement = connection.prepareStatement("SELECT EXISTS (SELECT 1 FROM schools WHERE representative_name = ? AND representative_email = ?) AS user_exists");
            preparedStatement.setString(1, RepresentativeName); // 1st question mark will be replaced by representative_name
            preparedStatement.setString(2, email); // 2nd question mark will be replaced by email
            result = preparedStatement.executeQuery();
    
            // Check if the user exists
            if (result.next()) {
                IsValid = result.getBoolean("user_exists");
            }
    
        } catch (SQLException ex) {
            System.out.println("An error occurred. Maybe user/password is invalid");
            ex.printStackTrace();
        } finally {
            try {
                if (connection != null) {
                    connection.close();
                }
                if (result != null) {
                    result.close();
                }
                if (preparedStatement != null) {
                    preparedStatement.close();
                }
            } catch (SQLException ex) {
                ex.printStackTrace();
            }
        }
        return IsValid; // Returns true if user exists and false otherwise
    }

    //method returns rep details basing on school id
    public static Representative getRepresentativeBySchoolRegNo(int schoolRegNo) {
        Representative representative = null;
        Connection conn = null;
        PreparedStatement pstmt = null;
        ResultSet rs = null;
        try {
            // Load the JDBC driver
            Class.forName("com.mysql.cj.jdbc.Driver");
            // Establish a connection to the database
            conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/mathematics_challenge", "root", "");
    
            // Prepare the SQL query
            String query = "SELECT representative_name, representative_email FROM schools WHERE registration_no = ?";
            pstmt = conn.prepareStatement(query);
            pstmt.setInt(1, schoolRegNo);
    
            // Execute the query
            rs = pstmt.executeQuery();
    
            // Process the result set
            if (rs.next()) {
                String representativeName = rs.getString("representative_name");
                String email = rs.getString("representative_email");
                representative = new Representative(representativeName, email);
            }
        } catch (ClassNotFoundException e) {
            System.out.println("MySQL JDBC Driver not found.");
            e.printStackTrace();
        } catch (SQLException e) {
            System.out.println("Database connection failure.");
            e.printStackTrace();
        } finally {
            // Clean up resources
            try {
                if (rs != null) rs.close();
                if (pstmt != null) pstmt.close();
                if (conn != null) conn.close();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
        return representative;
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
