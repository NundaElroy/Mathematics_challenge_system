import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.sql.*;
import java.io.Serializable;
import java.time.*;

public class Question implements Serializable{
    private int questionId;
    private String question;
    private List<String> options = new ArrayList<>();
    private String correctAnswer;
    private int  marksScored;
    private String participantAnswer;
    private String Timetaken ;
    private static final int CORRECT_MARKS = 10; 
    private static final int WRONG_MARKS = -3;
    private static final int IDK_MARKS = 0;
      
    public Question(int questionId, String question, String option1, String option2, String option3,String option4, String correctAnswer) {
        this.questionId = questionId;
        this.question = question;
        // Add options to the list
        options.add(option1);
        options.add(option2);
        options.add(option3);
        options.add(option4);
        // Shuffle the options
        Collections.shuffle(options);
        // Assign the shuffled options to the correct answer based on the original correct answer
        this.correctAnswer = correctAnswer;
    }

    public static void main(String[] args) {
        List<Question> questions = fetchRandomQuestions();
        int counter = 1;
        for (Question question : questions) {
            question.displayQuestion(counter);
            counter +=1;
        }
       
    }

    //method to check answer
     public int checkAnswer(String userAnswer) {
        //the answer the user has entered 
            this.participantAnswer = userAnswer;

            //when user doesnt know
            if (userAnswer.equalsIgnoreCase("-") ) {
                
                this.marksScored =  IDK_MARKS;
                return IDK_MARKS;
            
            //answers correctly
            }else if(userAnswer.equalsIgnoreCase(null)||(userAnswer.equalsIgnoreCase(""))){
                this.marksScored =  IDK_MARKS;
                return IDK_MARKS;
            
            }else if(userAnswer.equalsIgnoreCase(this.correctAnswer)) {
                this.marksScored = CORRECT_MARKS;
                
                return CORRECT_MARKS;
            //answers wrongly
            }else{
                this.marksScored = WRONG_MARKS;
                return WRONG_MARKS;
            }
            
           
        }
    
   //method to display question details
    public void displayQuestion(int number) {
        System.out.println("_".repeat(100));
        System.out.println(number + ". " + question);
        System.out.println("."+options.get(0) + "   " +"."+ options.get(1) +"   " + "."+options.get(2)+ "  "+ "."+options.get(3));
        
        //timer is gonna run 5 seconds(to cater for reaction of particapant)
        //and the moment the enter key is pressed the timer stops for that question
    }

    public void displayQuestionDetails(){
        System.out.println(this.questionId);
        System.out.println(this.question);
        System.out.println(this.participantAnswer);
        System.out.println(this.marksScored);
        System.out.println(this.Timetaken);
    }

    //fetching 10 random questions from the database
public static List<Question> fetchRandomQuestions() {
    List<Question> questions = new ArrayList<>();
    String url = "jdbc:mysql://localhost:3306/dummy_database"; 
    String username = "root"; 
    String password = "";  
    String query = "SELECT q.questionid, question_text, option1, a.option2, a.option3,a.option4, a.correct_answer " +
                   "FROM questions q JOIN answers a ON q.questionid = a.question " +
                   "ORDER BY RAND() LIMIT 10"; // This is for MySQL, adjust for your DBMS

    try (Connection conn = DriverManager.getConnection(url, username, password);
         Statement stmt = conn.createStatement();
         ResultSet rs = stmt.executeQuery(query)) {

        while (rs.next()) {
            int questionId = rs.getInt("questionid");
            String questionText = rs.getString("question_text");
            String option1 = rs.getString("option1");
            String option2 = rs.getString("option2");
            String option3 = rs.getString("option3");
            String option4 = rs.getString("option4");
            String correctAnswer = rs.getString("correct_answer");
            
            Question question = new Question(questionId, questionText, option1, option2, option3,option4, correctAnswer);
            questions.add(question);
        }
    } catch (SQLException e) {
        e.printStackTrace();
    }
    return questions;
}
    
    
//setter for totaltime taken
    public void setTimetaken(Duration duration){
        
        long hours =  duration.toHours();
        long minutes = duration.toMinutes() % 60;
        long seconds = duration.getSeconds() % 60;
        String formattedDuration = String.format("%02d:%02d:%02d", hours,minutes,seconds);
        this.Timetaken = formattedDuration;
    }
     // Getter for Timetaken
     public String getTimetaken() {
        return Timetaken;
    }

    public int getQuestionId(){
        return this.questionId;
    }

    public int getMarksScored() {
        return marksScored;
    }

    // Setter for marksScored
    public void setMarksScored(int marksScored) {
        this.marksScored = marksScored;
    }

    // Getter for participantAnswer
    public String getParticipantAnswer() {
        return participantAnswer;
    }

     // Setter for participantAnswer
     public void setParticipantAnswer(String participantAnswer) {
        this.participantAnswer = participantAnswer;
    }

   

   
   

    
}

