import java.io.*;
import java.net.*;
import java.util.*;

public class Server {
 public static void main(String[] args) {
    ServerSocket socket = null;
    Socket ClientSocket = null;
    OutputStreamWriter out  = null;
    InputStreamReader in  = null;
    BufferedReader reader = null;
    BufferedWriter writer = null;
    
    try{
        socket = new ServerSocket(9999);
        System.out.println("waiting for connection...........");
        ClientSocket = socket.accept();
        System.out.println("client connected");
        out  = new OutputStreamWriter(ClientSocket.getOutputStream());
        in  = new InputStreamReader(ClientSocket.getInputStream());
        reader = new BufferedReader(in);
        writer = new BufferedWriter(out);
        while (true) {
            writer.write("Type in option \n Register \n Login \n quit \n ");
            writer.newLine();
            writer.flush();
            //response of the client
            String clientResponse = reader.readLine();
            System.out.println(clientResponse);
            
            
             // Assuming 'reader' is set up to read from the client
             if (clientResponse.equalsIgnoreCase("Quit")) {
                writer.write("Goodbye, thank you for using the system");
                writer.newLine();
                writer.flush();
                // Exit loop
                break;
            }
             

            // Process client response
             else if (clientResponse.equalsIgnoreCase("Register")) {
                //send registration instructions
                

                // Read registration details
                String registrationDetails = reader.readLine();

                

                //going to just copy the details to a txt 
                //registration number
                // username 
                // password
                // firstname
                // lastname 
                //emailaddress 
                // dateofbirth 
                // status 
                //filepathofphoto
                
                //applicant details stored onto a file on the server for confirmation later on 
                registerApplicant(registrationDetails);
                
                //server response for successful application 
                writer.write("Registration successful");
                writer.newLine();
                writer.flush();
                

                
              //hadling a login response  
            } else if (clientResponse.equalsIgnoreCase("Login")) {
                //send login user instructions
                writer.write("login as participant or rep (for representative)");
                writer.newLine();
                writer.flush();

                // Read login choice
                String TypeOfUser = reader.readLine();

                // Process login choice
                if (TypeOfUser.equalsIgnoreCase("rep")){
                    //loop for incase wrong credentials
                   

                    writer.write("enter login details in the form Representativename/email");
                    writer.newLine();
                    writer.flush();

                    //receive login credentials
                    String responseOfRep = reader.readLine();
                    String [] credentials = splitString(responseOfRep); // the repName and email for verification
                    Representative rep1 = new Representative(credentials[0], credentials[1]);
                    boolean authentication = false ;
                    //unsuccessful login
                    if (!rep1.login()){
                        
                        writer.write("!none"); //send a message to the client
                                                  // where !none is a flag for unsuccessful login
                        writer.newLine();
                        writer.flush();
                        continue;

                   //successful login
                    }else{
                        writer.write("login successful / user found");
                        writer.newLine();
                        writer.flush();
                        System.out.println("welcome to the representative menu");//logging to check the error
                         
                        authentication = true; //to track login session 
                        //sending the menu 
                        while(authentication){
                            writer.write("enter prompt \n viewApplicants \n confirmApplicants \n quit \n");
                            writer.newLine();
                            writer.flush();

                         //read the menu choice
                         String menuChoice = reader.readLine();

                        if (menuChoice.equalsIgnoreCase("viewApplicants")){
                            //read the applicants from the file
                                ObjectOutputStream outputStream = new ObjectOutputStream(ClientSocket.getOutputStream());
                                List<Map<String, String>> applicants = readApplicantsFromFile("C:\\Users\\Alvin\\OneDrive\\Desktop\\Mathematics_challenge_system\\java\\JavaCommandLine\\src\\Applicants.txt");
                              
                                
                                //send the applicants to the client
                                outputStream.writeObject(applicants);
                                System.out.println("Data sent to the client.");
                                
                        
                        
                       }else if(menuChoice.equalsIgnoreCase("confirmApplicants")){
                        //read applicants from files
                        ArrayList<String> applicants;
                        String applicant;
                        while (true) {
                             applicants = readApplicantsFromFileForConfirmation("C:\\Users\\Alvin\\OneDrive\\Desktop\\Mathematics_challenge_system\\java\\JavaCommandLine\\src\\Applicants.txt");
                           //checking if applicants are done
                            if (applicants.isEmpty()) {
                                writer.write("No applicants to confirm..redirecting back to representative menu");
                                writer.newLine();
                                writer.flush();
                                break;
                        
                            }else{
                                //access applicant details at the beginning of the list for confirmation
                                applicant = applicants.get(0);
                                writer.write(applicant);
                                writer.newLine();
                                writer.flush();

                            }
                        
                        //read the response of the representative
                        String confirmationResponse = reader.readLine();
                        if (confirmationResponse.equalsIgnoreCase("yes")){

                            //converting to pupil object and setting status true and a method to move applicant to participant database
                            //split the applicant details
                            String[] applicantDetails = splitString(applicant);
                            //make them a pupil object
                            Pupil pupil = new Pupil(applicantDetails[0], applicantDetails[1], applicantDetails[2], applicantDetails[3], applicantDetails[4], applicantDetails[5], applicantDetails[6]);
                            pupil.setStatus(true);
                            pupil.registerPupil();
                            
                            //remove the applicant from the list
                            applicants.remove(0);
                            //write the remaining applicants back to the file
                            writeToFile("C:\\Users\\Alvin\\OneDrive\\Desktop\\Mathematics_challenge_system\\java\\JavaCommandLine\\src\\Applicants.txt", applicants);
                            
                        }else if(confirmationResponse.equalsIgnoreCase("no")){
                            //converting to pupil object and setting status false and a method to move applicant to rejected database
                            //split the applicant details
                            String[] applicantDetails = splitString(applicant);
                            //make them a pupil object
                            Pupil pupil = new Pupil(applicantDetails[0], applicantDetails[1], applicantDetails[2], applicantDetails[3], applicantDetails[4], applicantDetails[5], applicantDetails[6]);
                            pupil.setStatus(false);
                            pupil.registerPupil();
                            //remove the applicant from the list
                            applicants.remove(0);
                            //write the remaining applicants back to the file
                            writeToFile("C:\\Users\\Alvin\\OneDrive\\Desktop\\Mathematics_challenge_system\\java\\JavaCommandLine\\src\\Applicants.txt", applicants);
                        }else if(confirmationResponse.equalsIgnoreCase("Quit")){
                            //terminate the session for rep
                            
                            System.out.println("confirmation session has ended");
                            
                            break;
                        }else{
                            writer.write("Invalid choice");
                            writer.newLine();
                            writer.flush();
                            
                        }
                            
                        }
                        

                       }else if(menuChoice.equalsIgnoreCase("Quit")){
                        //Terminate the session for rep
                        System.out.println("representative logged out....");
                        break;
                        }else{  
                            writer.write("Invalid choice");
                            writer.newLine();
                            writer.flush();
                            
                        }
                    
                   
                   
                   //going to send  menu related to the supervisor that is  view applicants or confirm applicants


                }
            
                //handling the participant login and user functionalities
            } }else if (TypeOfUser.equalsIgnoreCase("participant")){
                    writer.write("enter login details in the form username/email");
                    writer.newLine();
                    writer.flush();

                    //receive login credentials
                    String responseOfParticipant = reader.readLine();
                    String [] participantCredentials = splitString(responseOfParticipant); // the repName and email for verification
                    boolean loginStatus = Pupil.login(participantCredentials[0], participantCredentials[1]);
                    boolean authentication1 = false ;

                    //unsuccessful login
                    if (!loginStatus){
                        
                        writer.write("!none"); //send a message to the client
                                                  // where !none is a flag for unsuccessful login
                        writer.newLine();
                        writer.flush();
                        continue;
                    }else{
                        writer.write("login successful / user found");
                        writer.newLine();
                        writer.flush();
                        System.out.println("welcome to the participant menu");//logging to check the error
                         
                        authentication1 = true; //to track login session 
                        //sending the menu 
                        while(true){
                            writer.write("enter prompt \n viewChallenges \n attemptChallenge \n quit \n");
                            writer.newLine();
                            writer.flush();

                            //read the menu choice
                            String menuChoice2 = reader.readLine();

                        if (menuChoice2.equalsIgnoreCase("viewChallenges")){
                            //available challenges fetched from a database and stored in a list 
                            List<Challenge> availableChallenges = Challenge.displayAvailableChallenges();
                            //list object  sent over stream
                            ObjectOutputStream out2 = new ObjectOutputStream(ClientSocket.getOutputStream());
                            out2.writeObject(availableChallenges);    
                            System.out.println(" Data sent to the client.");

                                
                        }else if(menuChoice2.equalsIgnoreCase("attemptChallenge")){
                            //TODO implement the attempt challenge method/functionality
                        
                        
                       }else if(menuChoice2.equalsIgnoreCase("Quit")){
                        //Terminate the session for rep
                        System.out.println("participant logged out....");
                        break;
                       
                        }else{  
                            writer.write("Invalid choice");
                            writer.newLine();
                            writer.flush();
                            
                        }

            } }}else {
                System.out.println("invalid input");
            }
            }
              
          
            
            
        
 }}catch(IOException e){
    e.printStackTrace();
 }finally{
    try{
        ClientSocket.close();
        reader.close();
        
        writer.close();


    }catch(IOException e){
        e.printStackTrace();
    }
 }
 }

 //moves the applicants details onto a text file
 private static void registerApplicant(String registrationDetails){
    File file = null;
    FileWriter writer = null;
    BufferedWriter out = null;

    try{
        file = new File("C:\\Users\\Alvin\\OneDrive\\Desktop\\Mathematics_challenge_system\\java\\JavaCommandLine\\src\\Applicants.txt");
        writer = new FileWriter(file,true);
        out = new BufferedWriter(writer);
        out.write(registrationDetails);
        out.newLine();
        out.flush();
        System.out.println("Applicant registered");
    }catch(IOException e){
        e.printStackTrace();
    }
}

//method for splitting strings



//method for handling string splitting
private static String[] splitString(String str){
    return str.split("/");
}

//method for reading data into a file and converts into a list data structure for serialization
private static List<Map<String, String>> readApplicantsFromFile(String filePath) throws IOException {
    List<Map<String, String>> applicants = new ArrayList<>();
    try (BufferedReader reader = new BufferedReader(new FileReader(filePath))) {
        String line;
        while ((line = reader.readLine()) != null) {
            String[] parts = line.split("/");
            if(parts.length < 2){
                break;
            }
            Map<String, String> applicant = new HashMap<>();
            applicant.put("ID", parts[0]);
            applicant.put("Username", parts[1]);
            applicant.put("FirstName", parts[2]);
            applicant.put("LastName", parts[3]);
            applicant.put("Email", parts[4]);
            applicant.put("DOB", parts[5]);
            applicant.put("PhotoPath", parts[6]);
            applicants.add(applicant);
        }
    }
    return applicants;
}
//method that reads from applicants file for confirmation
private static  ArrayList<String> readApplicantsFromFileForConfirmation(String filePath) throws IOException {
    ArrayList<String> applicants = new ArrayList<>();
    try (BufferedReader reader = new BufferedReader(new FileReader(filePath))) {
        String line;
        while ((line = reader.readLine()) != null) {
            applicants.add(line);
        }
    }
    return applicants;
}
//static method to write objects from arrayList to file
public static void writeToFile(String filePath, ArrayList<String> applicants) throws IOException {
    FileWriter writer = new FileWriter(filePath);
                            BufferedWriter out = new BufferedWriter(writer);
                            for (String applicant1 : applicants){
                                out.write(applicant1);
                                out.newLine();
                                out.flush();
                            }
                            out.close();
                            writer.close();
    }

    public static void printArrayContents(Object[] array) {
        for (Object element : array) {
            System.out.println(element);
        }
    }

}


