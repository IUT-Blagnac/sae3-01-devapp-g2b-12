import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.image.Image;
import javafx.scene.layout.AnchorPane;
import javafx.stage.Stage;
import view.MainPageController;

import java.io.IOException;

/**
 * Classe principale servant à lancer l'application
 * @author Rémy Guibert
 */
public class Main extends Application {

	/**
	 * Contrôleur de l'application
	 */
	private MainPageController ctrl;

    public static void main(String[] args) {
        launch();
    }

    /**
     * Charge la vue et le contrôleur et affiche l'application
     */
    @Override
    public void start(Stage stage) throws IOException {

        FXMLLoader fxmlLoader = new FXMLLoader(Main.class.getResource("view/MainPage.fxml"));

        AnchorPane vueListe = fxmlLoader.load();
        ctrl = fxmlLoader.getController();

        Scene scene = new Scene(vueListe, 1050, 575);

        stage.getIcons().add(new Image(Main.class.getResource("resources/icon.png").toExternalForm()));
        stage.setTitle("Visualisation des données de l'entrepôt");
        stage.setScene(scene);
        stage.setResizable(false);
        stage.show();
    }

    /**
     * Met fin à la planification afin d'arrêter les Thread et de fermer l'application
     */
    @Override
    public void stop(){
    	ctrl.cancelScheduling();
    }

}