import java.time.LocalDateTime;
import java.time.temporal.ChronoUnit;

public class ChallengeAttempt {
    private LocalDateTime startTime;
    private static final long MAX_DURATION_MINUTES = 1; // Maximum duration of 30 minutes

    public ChallengeAttempt() {
        // Start the timer when the attempt is created
        this.startTime = LocalDateTime.now();
    }
    public static void main(String[] args) throws InterruptedException {
        ChallengeAttempt attempt = new ChallengeAttempt();
    
        // Simulate the challenge attempt with periodic checks
        while (!attempt.isTimeUp()) {
            System.out.println("Challenge is ongoing. Remaining time: " + attempt.getRemainingTime() + " minutes.");
            // Simulate doing part of the challenge for 5 seconds
            Thread.sleep(5000); // Sleep for 5 seconds
        }
    
        // Once the loop exits, the time is up
        System.out.println("Time is up! You can no longer attempt this challenge.");
    }

    public boolean isTimeUp() {
        // Calculate the elapsed time since the start
        long elapsedMinutes = ChronoUnit.MINUTES.between(startTime, LocalDateTime.now());

        // Check if the elapsed time has exceeded the maximum duration
        return elapsedMinutes >= MAX_DURATION_MINUTES;
    }

    public void attemptChallenge() {
        // Example method where the challenge attempt logic would be implemented

        // Check if the time is up before proceeding
        if (isTimeUp()) {
            System.out.println("Time is up! You can no longer attempt this challenge.");
            return; // End the attempt
        }

        // Challenge attempt logic goes here
        // This could be periodically checked during the attempt to ensure compliance with the time limit
    }

    // Optionally, a method to provide feedback about the remaining time
    public long getRemainingTime() {
        long elapsedMinutes = ChronoUnit.MINUTES.between(startTime, LocalDateTime.now());
        long remainingTime = MAX_DURATION_MINUTES - elapsedMinutes;
        return Math.max(0, remainingTime); // Ensure the remaining time doesn't go below 0
    }
}