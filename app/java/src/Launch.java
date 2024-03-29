import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.image.Image;
import javafx.scene.layout.AnchorPane;
import javafx.stage.Stage;
import view.MainFrameController;

import java.io.IOException;

/**
 * Classe servant à lancer l'application
 * @author Groupe 12
 */
public class Launch extends Application {

	/**
	 * Contrôleur de l'application
	 */
	private MainFrameController ctrl;

    public static void main(String[] args) {
        launch();
    }

    /**
     * Charge la vue et le contrôleur et affiche l'application
     */
    @Override
    public void start(Stage stage) throws IOException {

        FXMLLoader fxmlLoader = new FXMLLoader(Launch.class.getResource("view/MainFrame.fxml"));

        AnchorPane vueListe = fxmlLoader.load();
        ctrl = fxmlLoader.getController();

        Scene scene = new Scene(vueListe, 1050, 575);

        stage.getIcons().add(new Image(Launch.class.getResource("icon.png").toExternalForm()));
        stage.setTitle("Visualisation des données de l'entrepôt");
        stage.setScene(scene);
        stage.setResizable(false);
        stage.show();
    }

    /**
     * Met fin à la planification afin d'arrêter le Thread et fermer l'application
     */
    @Override
    public void stop(){
    	ctrl.cancelScheduling();
    }

}