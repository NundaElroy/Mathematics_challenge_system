import java.io.InputStream;
import java.io.IOException;
import java.util.Properties;

public class AppConfig {
    private static Properties properties;

    // Static block to load the properties file when this class is first used
    static {
        properties = new Properties();
        try (InputStream inputStream = AppConfig.class.getClassLoader().getResourceAsStream("config.properties")) {
            if (inputStream == null) {
                throw new IOException("config.properties file not found in classpath");
            }
            properties.load(inputStream);
        } catch (IOException e) {
            e.printStackTrace(); // Handle the exception properly in real applications
        }
    }

    // Method to get the image upload path from the properties
    public static String getImageFolderPath() {
        return properties.getProperty("image_folder_path");
    }

    // Method to get the applicant file path from the properties
    public static String getApplicantFilePath() {
        return properties.getProperty("applicant_file_path");
    }
    public static void main(String[] args) {
        System.out.println(AppConfig.getImageFolderPath());
        System.out.println(AppConfig.getApplicantFilePath());
    }
}