package com.example.demo;

import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.chart.LineChart;
import javafx.scene.chart.NumberAxis;
import javafx.scene.chart.XYChart;
import javafx.scene.layout.Border;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.VBox;
import javafx.scene.shape.Line;
import javafx.stage.Stage;

import java.io.IOException;

public class HelloApplication extends Application {
    @Override
    public void start(Stage stage) throws IOException {

        FXMLLoader fxmlLoader = new FXMLLoader();
        fxmlLoader.setLocation(HelloApplication.class.getResource("hello-view.fxml"));

        BorderPane vueListe = fxmlLoader.load();

        Scene scene = new Scene(vueListe, 800, 800);

        stage.setTitle("Visualisation des données");
        stage.setScene(scene);
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
        

    }

}