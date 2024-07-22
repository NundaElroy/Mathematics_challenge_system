import java.util.ArrayList;
import java.util.List;
import java.sql.*;
import java.io.Serializable;
import java.time.*;

public class Question implements Serializable{
    private int questionId;
    private String question;
    private String correctAnswer;
    private int  marksScored;
    private String participantAnswer;
    private String Timetaken ;
    private  int CORRECT_MARKS ;//marks per question
    private static final int WRONG_MARKS = -3;
    private static final int IDK_MARKS = 0;
      
    public Question(int questionId, String question,  String correctAnswer, int marksForQuestion) {
        this.questionId = questionId;
        this.question = question;
        this.CORRECT_MARKS = marksForQuestion;
        this.correctAnswer = correctAnswer;
    }

    public static void main(String[] args) {
        // List<Question> questions = fetchRandomQuestions();
        // int counter = 1;
        // for (Question question : questions) {
        //     question.displayQuestion(counter);
        //     counter +=1;
        // }
       
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
    }
  //testing functionality of the class
    public void displayQuestionDetails(){
        System.out.println("questionid:"+this.questionId);
        System.out.println("question:"+this.question);
        System.out.println("choice:"+this.participantAnswer);
        System.out.println("mark:"+this.marksScored);
        System.out.println("correct:"+this.correctAnswer);
        System.out.println("marksforquestion:"+this.CORRECT_MARKS);
        System.out.println("time:"+this.Timetaken);
    }

    //fetching 10 random questions from the database

    public static List<Question> fetchRandomQuestions(int challengeId, int numberOfQuestionsPerChallenge) {
        List<Question> questions = new ArrayList<>();
        String url = "jdbc:mysql://localhost:3306/mathematics_challenge"; 
        String username = "root"; 
        String password = ""; // Update the password if necessary
        String query = "SELECT q.questionid, q.question_text, q.marks, a.correct_answer " +
                       "FROM questions q JOIN answers a ON q.questionid = a.question " +
                       "WHERE q.challengeId = ? ORDER BY RAND() LIMIT   ?";
    
        try (Connection conn = DriverManager.getConnection(url, username, password);
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setInt(1, challengeId);
            pstmt.setInt(2, numberOfQuestionsPerChallenge); // Set the challengeId parameter
            
            try (ResultSet rs = pstmt.executeQuery()) {
                while (rs.next()) {
                    int questionId = rs.getInt("questionid");
                    String questionText = rs.getString("question_text");
                    int marks = rs.getInt("marks");
                    String correctAnswer = rs.getString("correct_answer");
                    
                    // Assuming Question constructor can handle these parameters or has been adjusted accordingly
                    Question question = new Question(questionId, questionText, correctAnswer, marks);
                    questions.add(question);
                }
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
    //getter for correct answer
    public String getCorrectAnswer(){
        return this.correctAnswer;

    }

   

   
   

    
}

