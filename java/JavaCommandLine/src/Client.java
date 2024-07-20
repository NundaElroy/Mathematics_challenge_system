import java.io.*;
import java.net.*;
import java.util.*;

public class Client  {
   public static void main (String [] args){
    Socket socket = null;
    OutputStreamWriter out  = null;
    InputStreamReader in  = null;
    BufferedReader reader = null;
    BufferedWriter writer = null;
    Scanner scanner = null;
    try {
        socket = new Socket("localhost",9999);
        in = new InputStreamReader(socket.getInputStream());
        out = new OutputStreamWriter(socket.getOutputStream());
        reader = new BufferedReader(in);
        writer = new BufferedWriter(out);
        scanner = new Scanner(System.in);
        System.out.println("connected to server");
        System.out.println("_".repeat(50));
        System.out.println("\033[1;36mwelcome to the mathematics challenge commandLine system\033[0m");
        while (true) {
            
            String line;
            int counter = 0;

            //menu sent by the server
            while ((line = reader.readLine()) != null) {
                if (counter > 3 ){
                    break;
                }
                counter++;
                
                System.out.println(line);
            }
            System.out.println("\033[0;32mnote for register use register/username/password/firstname/lastname/email/dob/photoPath\033[0m");

           //prompting the user for a response
            System.out.println("_".repeat(50));
            ////user response in form of register or login but register has registe/registration details
            String responseFromUser = scanner.nextLine();
            // incase its register we split the command from the details of the pupil 
            String [] responseArray = responseFromUser.split("/");
            //command corresponds to first element in array
            String response = responseArray[0];
            writer.write(response);
            writer.newLine();
            writer.flush();


            //client side handling of the response
            if (response.equalsIgnoreCase("quit")) {
                System.out.println("testing 1,2,3");
                
                System.out.println(reader.readLine());
                
                 break;
                
            }else if (response.equalsIgnoreCase("Register")) {
               //client side validation
               System.out.println("_".repeat(50));
               
                while (true) {

                String [] newArray = Arrays.copyOfRange(responseArray, 1, responseArray.length);
                String registrationDetails = String.join("/",newArray);
                
                
                System.out.println("_".repeat(50));
                System.out.println("\u001B[32mconfirm your details if correct: enter yes or no for not incorrect/order\u001B[0m");
                System.out.println("_".repeat(50));
                String confirm = scanner.nextLine();
                
                if (confirm.equalsIgnoreCase("yes")) {
                    System.out.println(registrationDetails);
                    //sending the registration details to the server
                    System.out.println("_".repeat(50));
                    System.out.println("\u001B[32mloading.... wait a moment\u001B[0m");
                    System.out.println("_".repeat(50));
                    writer.write(registrationDetails);
                    writer.newLine();
                    writer.flush();
                    System.out.println(reader.readLine());
                    System.out.println("_".repeat(50));
                    break;
                }else{
                    System.out.println("\033[0;31mtry again\033[0m");
                    System.out.println("_".repeat(50));
                    System.out.println("\u001B[31mtry again regsiter/username/password/firstname/lastname/email/dob/photoPath\u001B[0m");
                    String tryAgainResponse = scanner.nextLine();
                    responseArray = tryAgainResponse.split("/");
                    System.out.println("_".repeat(50));
                    
                }

                
                    
                }

            
            
            
        }else if(response.equalsIgnoreCase("login")){

            //login instructions from server
            System.out.println("_".repeat(50));
            System.out.println(reader.readLine());

            //response can be rep or participant
            
            String  TypeOfUser = scanner.nextLine();
            writer.write(TypeOfUser);
            writer.newLine();
            writer.flush();
            
            //instructions for rep/participant
            System.out.println("_".repeat(50));
            System.out.println(reader.readLine());

            //login details for rep/participant
            while (true) {
                String loginDetails = scanner.nextLine();
                System.out.println("_".repeat(50));
                System.out.println("\u001B[32mconfirm your details if correct: enter yes or no for not incorrect/order\u001B[0m");
                String confirm = scanner.nextLine();
                System.out.println("_".repeat(50));
                
                if (confirm.equalsIgnoreCase("yes")) {
                    System.out.println("\u001B[32mloading.... wait a moment\u001B[0m");
                    writer.write(loginDetails);
                    writer.newLine();
                    writer.flush();
                    
                    break;
                }else{
                    System.out.println("\u001B[31mtry again\u001B[0m");
                    
                }
           
            }


             String serverResponse = reader.readLine();
             if(serverResponse.equalsIgnoreCase("!none")){
                System.out.println("_".repeat(50));
                System.out.println("\u001B[31mlogin failed, try again\u001B[0m");
                System.out.println("_".repeat(50));

                continue;
             }
             System.out.println("_".repeat(50));
             //letting the rep/participant know of the successful login
             System.out.println(serverResponse);
             System.out.println("_".repeat(50));
             //receiving of menu
             

            //when its the representative
            if(TypeOfUser.equalsIgnoreCase("rep")){
               //TRACKING Autheentication
               //incase the login is successful
               while(true){
                //handling going quitting to correapond to the server
                
                 //receiving menu
                 String line1;
                 int counter1 = 0;
                 while ((line1 = reader.readLine()) != null) {
                     if(counter1 >3 ){
                         break;
                     }
 
                     counter1++;
                     System.out.println(line1);
                     
                 }
                 System.out.println("_".repeat(50));
                 //response can be viewapplicants /confirm applicants / quit
                 String repResponse = scanner.nextLine();
                 System.out.println("_".repeat(50));
                 writer.write(repResponse);
                 writer.newLine();
                 writer.flush();
                 if(repResponse.equalsIgnoreCase("viewApplicants")){
                     //receiving applicants list objec
                     ObjectInputStream inputStream = new ObjectInputStream(socket.getInputStream());
                     @SuppressWarnings("unchecked")
                     List<Map<String, String>> applicants = (List<Map<String, String>>) inputStream.readObject();
                     System.out.println("_".repeat(230));
                     printApplicantsInTable(applicants);
                     System.out.println("_".repeat(230));
                 }else if(repResponse.equalsIgnoreCase("confirmApplicants")){
                     //receiving first applicant
                     while(true){
                     System.out.println("_".repeat(50));
                     String Applicantdetail = reader.readLine();
                     //checking if the list is empty response from server
                        if(Applicantdetail.equalsIgnoreCase("No applicants to confirm..redirecting back to representative menu")){
                            System.out.println("_".repeat(50));
                            System.out.println("redirecting back to representative  menu");
                            System.out.println("_".repeat(50));
                            break;
                        }
                     System.out.println(Applicantdetail);
                     System.out.println("_".repeat(50));
                     System.out.println("\u001B[32myes to accept applicant and no to reject or quit to exit\u001B[0m");

                     String confirmApplicant = scanner.nextLine();
                     writer.write(confirmApplicant);
                     writer.newLine();
                     writer.flush();
 
                     if(confirmApplicant.equalsIgnoreCase("quit")){
                        System.out.println("\u001B[34mredirecting back to previous menu\u001B[0m");
                        
                         break;
                     }
                     
                     }
                     
                 }else if (repResponse.equalsIgnoreCase("quit")){
                    System.out.println("\033[0;32mrepresentative logged out\033[0m");
                     break;
                 }else{
                    System.out.println("\033[0;31minvalid response\033[0m");
 
                 }

               }
            }else if(TypeOfUser.equalsIgnoreCase("participant")){
                //TRACKING Autheentication
                //incase the login is successful
                while(true){
                 //handling going quitting to correapond to the server
                 
                  //receiving menu
                  String line1;
                  int counter1 = 0;
                  while ((line1 = reader.readLine()) != null) {
                      if(counter1 >3 ){
                          break;
                      }
  
                      counter1++;
                      System.out.println(line1);
                      
                  }
                  System.out.println("_".repeat(50));
                  System.out.println("\u001B[32mEnter 'challengeID/attemptChallenge'to attempt a challenge.\u001B[0m");
                  //response can be viewapplicants /confirm applicants / quit
                  String participantResponseFromConsole = scanner.nextLine();
                  //Array to hold response data and case of attemptChallenge/challengeid
                  String [] responseData = participantResponseFromConsole.split("/"); 
                  String participantResponse = responseData[0];
                  System.out.println("_".repeat(50));
                  writer.write(participantResponse);
                  writer.newLine();
                  writer.flush();
                  if(participantResponse.equalsIgnoreCase("viewChallenges")){
                      //receiving the list object from 
                      ObjectInputStream in2 = new ObjectInputStream(socket.getInputStream());
                      @SuppressWarnings("unchecked")
                      
                      List<Challenge> availableChallenges = (List<Challenge>)in2.readObject();
                      //printing the available challenges from the list
                 
                      Challenge.printOutChallenges(availableChallenges);
                  }else if(participantResponse.equalsIgnoreCase("attemptChallenge")){
                      //Tchallengeid
                      String challengeid = responseData[2];
                      //send to server to confirm whether it exists
                      writer.write(challengeid);
                      writer.newLine();
                      writer.flush();

                      //receiving the server response
                      String serverRepRegardingChallenge = reader.readLine();

                      //handling the response
                      if(serverRepRegardingChallenge.equalsIgnoreCase("error")){
                        System.out.println("_".repeat(50));
                        System.out.println("\u001B[31m invalid challenge/doesnot exist\u001B[0m");
                        System.out.println("_".repeat(50));
                        
                      }else if(serverRepRegardingChallenge.equalsIgnoreCase("success")){
                        //server retrieving data and setting up the challenge so user is waiting 
                        System.out.println("_".repeat(50));
                        System.out.println("\u001B[32mloading.....please wait as we set up the challenge\u001B[0m");
                        System.out.println("_".repeat(50));
                        //receiving and deserializing challenge object
                        ObjectInputStream inputStream = new ObjectInputStream(socket.getInputStream());
                        
                        Challenge challenge = (Challenge)inputStream.readObject();
                        //Starting the challenge
                        challenge.startTimedChallenge();
                        //sending back challenge object after attempt
                        ObjectOutputStream outputStream = new ObjectOutputStream(socket.getOutputStream());
                        outputStream.writeObject(challenge);

                        System.out.println("_".repeat(50));
                        System.out.println("\u001B[32myou can check out other available challenges\u001B[0m");
                        System.out.println("_".repeat(50));
                        System.out.println("\u001B[32mloading.....please wait as we fetch the menu\u001B[0m");
                        System.out.println("_".repeat(50));
                        System.out.println("_".repeat(50));
                    
                      }

                     
                      
                  }else if (participantResponse.equalsIgnoreCase("quit")){
                      System.out.println("\033[0;32mparticipant logged out\033[0m");
                      break;
                  }else{

                      System.out.println(reader.readLine());
  
                  }
 
                }
             }
            }


    }}catch(IOException e){
        e.printStackTrace();
    }catch(ClassNotFoundException e){
        e.printStackTrace();
    }
    finally{
        try{
            socket.close();
            reader.close();
            writer.close();
            scanner.close();
        }catch(IOException e){
            e.printStackTrace();
        }}
    }


    //method to create table for the applicants view
    private static void printApplicantsInTable(List<Map<String, String>> applicants) {
        System.out.printf("%-5s %-15s %-20s %-10s %-30s %-10s %-20s%n", "ID", "Username", "First Name", "Last Name", "Email", "DOB", "Photo Path");
        for (Map<String, String> applicant : applicants) {
            System.out.printf("%-5s %-15s %-20s %-10s %-30s %-10s %-20s%n",
                    applicant.get("ID"),
                    applicant.get("Username"),
                    applicant.get("FirstName"),
                    applicant.get("LastName"),
                    applicant.get("Email"),
                    applicant.get("DOB"),
                    applicant.get("PhotoPath"));
        }
    }
}
   

   