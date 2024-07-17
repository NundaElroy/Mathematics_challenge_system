import java.io.InputStream;
import java.io.IOException;
import java.util.Properties;

public class AppConfig {
    private static Properties properties;

    // Static block to load the properties file when this class is first used
    static {
        properties = new Properties();
        try (InputStream inputStream = AppConfig.class.getResourceAsStream("java/JavaCommandLine/config.properties")) {
            properties.load(inputStream);
        } catch (IOException e) {
            e.printStackTrace(); // Handle the exception properly in real applications
        }
    }

    // Method to get the image upload path from the properties
    public static String getImageFolderPath() {
        return properties.getProperty("image_folder_path");
    }

    // Method to get another folder path from the properties
    public static String getApplicantFilePath() {
        return properties.getProperty("applicant_file_path");
    }
}
