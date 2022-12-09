import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.AnchorPane;
import javafx.stage.Stage;
import view.MainPageController;

import java.io.IOException;

public class Main extends Application {

	private MainPageController ctrl;

    @Override
    public void start(Stage stage) throws IOException {

        FXMLLoader fxmlLoader = new FXMLLoader(Main.class.getResource("view/MainPage.fxml"));

        AnchorPane vueListe = fxmlLoader.load();
        ctrl = fxmlLoader.getController();

        Scene scene = new Scene(vueListe, 1050, 575);

        stage.setTitle("Visualisation des données");
        stage.setScene(scene);
        stage.setResizable(false);
        stage.show();
    }

    public static void main(String[] args) {
        launch();
    }

    /**
        IMPORTANT:
        Quand l'application s'arrête, il faut arrêter
        la tâche de lecture, sinon elle continue.
     **/
    @Override
    public void stop(){
    	ctrl.arretLecture();
    }

}