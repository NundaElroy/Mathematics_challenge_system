import javax.mail.*;
import javax.mail.internet.*;
import java.io.File;
import java.io.IOException;
import java.util.Properties;


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
        String applicantDetails ="1001/janedoe/Jane/Doe/janedoe@example.com/1991-02-02/janedoe.jpeg";
        String representativeName = "kabali Johnson";
        String To="lyesmalek56@gmail.com";
        String Subject="Mathematics National Challenge";
        String Body = formatEmailBody(applicantDetails,representativeName);
        EmailSender email = new EmailSender(To,Subject,Body);
        email.sendEmailRemainderToRepresentative();


       
    }
    public  void sendEmailRemainderToRepresentative(){

        Properties properties=new Properties();

        properties.put("mail.smtp.host","smtp.gmail.com");
        properties.put("mail.smtp.port","600");
        properties.put("mail.smtp.auth",true);
        properties.put("mail.smtp.starttls.enable",true);
        properties.put("mail.transport.protocol","smtp");
        properties.put("mail.smtp.starttls.required","true");
        properties.put("mail.smtp.ssl.protocols","TLSv1.2" );
        properties.put("mail.smtp.socketFactory.class","javax.net.ssl.SSLSocketFactory");
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

            // MimeBodyPart attachment=new MimeBodyPart();
            // attachment.attachFile(new File("src/IMG_20240615_234637_696.jpg"));

            // MimeBodyPart attachment2=new MimeBodyPart();
            // attachment2.attachFile(new File("src/IMG_20240615_234637_696.jpg"));
            
            MimeBodyPart messageBodyPart=new MimeBodyPart();
            messageBodyPart.setContent(this.Body,"text/html");
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
        }// } catch (IOException e) {
        //     e.printStackTrace();
        // }

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
        
        // Other class members and methods...
    

    }
