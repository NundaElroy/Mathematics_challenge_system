import javax.mail.*;
import javax.mail.internet.*;
import java.util.Properties;
import java.io.*;


public class EmailSender {
        String To;
        String Subject;
        String Body;
        public EmailSender(String To , String Subject, String Body){
            this.To = To;
            this.Subject = Subject;
            this.Body = Body;
        }
        

    public static void main(String[] args) {
        // System.setProperty("https.protocols", "TLSv1.2");
        // String applicantDetails ="1001/janedoe/Jane/Doe/janedoe@example.com/1991-02-02/janedoe.jpeg";
        // String representativeName = "kabali Johnson";
        // String To="lyesmalek56@gmail.com";
        // String Subject="Mathematics National Challenge";
        // String Body = formatEmailBody(applicantDetails,representativeName);
        // EmailSender email = new EmailSender(To,Subject,Body);
        // email.sendEmailRemainderToRepresentative();
 
        String applicantDetails ="1001/janedoe/Jane/Doe/janedoe@example.com/1991-02-02/janedoe.jpeg";
        String To="yaweivan3@gmail.com";
        boolean isAccepted = false;
        String Subject="Mathematics National Challenge";
        String Body = formatEmailBodyApplicant(applicantDetails,isAccepted);
        EmailSender email = new EmailSender(To,Subject,Body);
        email.sendEmailRemainderToRepresentative();


       
    }
    public  void sendEmailRemainderToRepresentative(){

        Properties properties=new Properties();

        properties.put("mail.smtp.host","smtp.gmail.com");
        properties.put("mail.smtp.port","587");
        properties.put("mail.smtp.auth",true);
        properties.put("mail.smtp.starttls.enable",true);
        properties.put("mail.transport.protocol","smtp");
        properties.put("mail.smtp.starttls.required","true");
        properties.put("mail.smtp.ssl.protocols","TLSv1.2" );
        properties.put("mail.smtp.ssl.trust","smtp.gmail.com");
        // properties.put("mail.smtp.socketFactory.class","javax.net.ssl.SSLSocketFactory");
        properties.put("mail.debug", true);

        Session session=Session.getDefaultInstance(properties, new Authenticator() {
            @Override
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication("sekyezaelroy@gmail.com","clgk kzxw bxel dhdy");
            }
        });

        try{
            MimeMessage message=new MimeMessage(session);
           // message.setFrom(new InternetAddress(From));
            
            message.setSubject(this.Subject);
           // message.setContent(Body,"text/html");

//            Transport.send(message);
//            System.out.println("Email sent");
//
            Address addressTo=new InternetAddress(this.To);
            message.setRecipient(Message.RecipientType.TO,addressTo);
            
            MimeMultipart mimeMultipart=new MimeMultipart();

            MimeBodyPart attachment=new MimeBodyPart();
            attachment.attachFile(new File("C:\\Users\\elvoy\\OneDrive\\Desktop\\recess\\Mathematics_challenge_system\\public\\image\\logo1.jpg.webp"));

            // MimeBodyPart attachment2=new MimeBodyPart();
            // attachment2.attachFile(new File("src/IMG_20240615_234637_696.jpg"));
            
            MimeBodyPart messageBodyPart=new MimeBodyPart();
            messageBodyPart.setContent(this.Body,"text/html");
            // mimeMultipart.addBodyPart(attachment);
            mimeMultipart.addBodyPart(messageBodyPart);
            // mimeMultipart.addBodyPart(attachment);
            // mimeMultipart.addBodyPart(attachment2);

            message.setContent(mimeMultipart);

            Transport.send(message);
            System.out.println("Email sent");
            
            



        } catch (AddressException e) {
            e.printStackTrace();
        } catch (MessagingException e) {
            e.printStackTrace();
         }catch (IOException e) {
              e.printStackTrace();
         }

    }

    
        // Other class members and methods...
    
        public static String formatEmailBody(String applicantDetails, String representativeName) {
            String[] applicantData = applicantDetails.split("/");
            StringBuilder applicantDetailsFormatted = new StringBuilder();
            applicantDetailsFormatted.append("SchoolRegNumber: ").append(applicantData[0]).append("\n");
            applicantDetailsFormatted.append("Username: ").append(applicantData[1]).append("\n");
            applicantDetailsFormatted.append("FirstName: ").append(applicantData[2]).append("\n");
            applicantDetailsFormatted.append("LastName: ").append(applicantData[3]).append("\n");
            applicantDetailsFormatted.append("Email: ").append(applicantData[4]).append("\n");
            applicantDetailsFormatted.append("DOB: ").append(applicantData[5]).append("\n");
            
            String body = "<h1>Reminder: Participant Confirmation Needed</h1>" +
                            "<p>Dear " + representativeName + "</p>" +
                            "<p>We hope this message finds you well. We are writing to remind you that a new participant has just registered and requires your confirmation to complete their registration process.</p>" +
                            "<p>Participant Details:<br>" + 
                            applicantDetailsFormatted.toString().replace("\n", "<br>") + // Replace newlines with HTML line breaks for email formatting
                            "</p>" +
                            "<p>Please take a moment to review their registration details and confirm their participation at your earliest convenience. This will ensure they are fully integrated into our system and can begin participating without delay.</p>" +
                            "<p>Thank you for your prompt attention to this matter.</p>" +
                            "<p>Best regards,</p>" +
                            "<p>kasana Timothy<br>Head of Representatives</p>";
            return body;
        }
        
        // rejection and accepltance letter 
        public static String formatEmailBodyApplicant(String applicantDetails, boolean isAccepted) {
            String[] applicantData = applicantDetails.split("/");
            StringBuilder applicantDetailsFormatted = new StringBuilder();
            applicantDetailsFormatted.append("SchoolRegNumber: ").append(applicantData[0]).append("<br>");
            applicantDetailsFormatted.append("Username: ").append(applicantData[1]).append("<br>");
            applicantDetailsFormatted.append("FirstName: ").append(applicantData[2]).append("<br>");
            applicantDetailsFormatted.append("LastName: ").append(applicantData[3]).append("<br>");
            applicantDetailsFormatted.append("Email: ").append(applicantData[4]).append("<br>");
            applicantDetailsFormatted.append("DOB: ").append(applicantData[5]).append("<br>");
        
            String body;
            if (isAccepted) {
                body = "<h1>Congratulations: You've Been Accepted!</h1>" +
                        "<p>Dear " + applicantData[2] + " " + applicantData[3] + ",</p>" +
                        "<p>We are thrilled to inform you that your application has been accepted. Welcome to the team!</p>" +
                        "<p>Your Details:<br>" +
                        applicantDetailsFormatted.toString() +
                        "</p>" +
                        "<p>We are excited to have you on board and look forward to your participation in our upcoming events.</p>" +
                        "<p>Best regards,</p>" +
                        "<p>kasana Timothy<br>Head of Representatives</p>";
            } else {
                body = "<h1>Application Status: Not Accepted</h1>" +
                        "<p>Dear " + applicantData[2] + " " + applicantData[3] + ",</p>" +
                        "<p>After careful consideration, we regret to inform you that your application has not been accepted at this time.</p>" +
                        "<p>We appreciate your interest and encourage you to apply again in the future.</p>" +
                        "<p>Best regards,</p>" +
                        "<p>kasana Timothy<br>Head of Representatives</p>";
            }
            return body;
        }
    }
