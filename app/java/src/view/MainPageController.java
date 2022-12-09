package view;

import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.scene.chart.LineChart;
import javafx.scene.chart.XYChart;
import javafx.scene.control.Button;
import javafx.scene.control.TextArea;
import org.json.simple.JSONObject;
import org.json.simple.parser.JSONParser;
import java.io.FileReader;
import java.io.Reader;
import java.util.*;

public class MainPageController {

    private XYChart.Series seriesTemp = new XYChart.Series();

    private XYChart.Series seriesHumi = new XYChart.Series();

    private XYChart.Series seriesC02 = new XYChart.Series();

    @FXML
    private LineChart graphTemp;

    @FXML
    private LineChart graphHumi;

    @FXML
    private LineChart graphC02;

    @FXML
    private TextArea param1;
    @FXML
    private Button valider;

    private TimerTask lecture = new ReadTask();

    @FXML
    // Modifie le fichier de configuration
    private void actionValider() {

    }

    @FXML
    protected void initialize() {
        //Lecture répétée du fichier JSON
        new Timer().schedule(lecture, 0, 10000);

        modifierGraphiques();

    }

    //Modifie les graphiques
    private void modifierGraphiques() {

        // Titre des axes
        this.graphTemp.getYAxis().setLabel("Temps (minutes)");
        this.graphTemp.getXAxis().setLabel("Température");

        this.graphHumi.getYAxis().setLabel("Temps (minutes)");
        this.graphHumi.getXAxis().setLabel("Humidité");

        this.graphC02.getYAxis().setLabel("Temps (minutes)");
        this.graphC02.getXAxis().setLabel("Taux C02");

        // Séries de données
        this.seriesTemp.setName("Température en fonction du temps");
        this.seriesHumi.setName("Humidité en fonction du temps");
        this.seriesC02.setName("C02 en fonction du temps");

        // Ajout des séries aux graphiques
        this.graphTemp.getData().add(this.seriesTemp);
        this.graphHumi.getData().add(this.seriesHumi);
        this.graphC02.getData().add(this.seriesC02);

    }

    // Ajout d'une nouvelle valeur de température
    public void addTemp(long d) {
        Calendar calendar = GregorianCalendar.getInstance();
        int min = calendar.get(Calendar.MINUTE);

        XYChart.Data donnee = new XYChart.Data(Math.random()*d, min);

        this.seriesTemp.getData().add(donnee);
    }

    // Ajout d'une nouvelle valeur d'humidité'
    public void addHumi(long d) {
        Calendar calendar = GregorianCalendar.getInstance();
        int min = calendar.get(Calendar.MINUTE);

        XYChart.Data donnee = new XYChart.Data(Math.random()*d, min);

        this.seriesHumi.getData().add(donnee);
    }

    // Ajout d'une nouvelle valeur de C02
    public void addCO2(long d) {
        Calendar calendar = GregorianCalendar.getInstance();
        int min = calendar.get(Calendar.MINUTE);

        XYChart.Data donnee = new XYChart.Data(Math.random()*d, min);

        this.seriesC02.getData().add(donnee);
    }

    // Classe qui lit les données du fichier JSON
    public class ReadTask extends TimerTask {

        public void run() {
            JSONParser parser = new JSONParser();

            try {
                Reader rd = new FileReader("src\\test.json");

                JSONObject jsObj = (JSONObject) parser.parse(rd);

                long temp = (Long) jsObj.get("temperature");
                long humi = (Long) jsObj.get("humidite");
                long co2 = (Long) jsObj.get("co2");

                // System.out.println("Température: " + temp);
                // System.out.println("Humidité: " + humi);
                // System.out.println("CO2: " + co2);

                // Pour éviter l'erreur 'Not on FX application thread'
                Platform.runLater(() -> {
                    addTemp(temp);
                    addHumi(humi);
                    addCO2(co2);
                });

            } catch (Exception e) {
                e.printStackTrace();
            }
        }

    }
    public void arretLecture(){
        lecture.cancel();
    }
}