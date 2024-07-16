import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.IOException;

public class InputRead {
    private Thread inputThread;
    private BufferedReader reader;
    private String input;
    private boolean interrupted;

    public InputRead() {
        reader = new BufferedReader(new InputStreamReader(System.in));
        input = null;
        interrupted = false;
        inputThread = new Thread(new Runnable() {
            @Override
            public void run() {
                try {
                    input = reader.readLine();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
        });
        inputThread.start();
    }

    public String getInput() {
        try {
            inputThread.join();
        } catch (InterruptedException e) {
            interrupted = true;
            inputThread.interrupt();
        }
        return input;
    }

    public boolean isInterrupted() {
        return interrupted || inputThread.isInterrupted();
    }

    public void interrupt() {
        inputThread.interrupt();
    }
}
