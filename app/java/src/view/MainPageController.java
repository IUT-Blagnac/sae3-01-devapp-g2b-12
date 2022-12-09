package view;

import javafx.application.Platform;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.Node;
import javafx.scene.chart.LineChart;
import javafx.scene.chart.NumberAxis;
import javafx.scene.chart.XYChart;
import javafx.scene.control.Button;
import javafx.scene.control.CheckBox;
import javafx.scene.control.ScrollPane;
import javafx.scene.control.TextField;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.GridPane;

import java.io.File;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.IOException;
import java.io.Reader;
import java.net.URL;
import java.util.*;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.google.gson.JsonParser;

public class MainPageController implements Initializable {

    private XYChart.Series seriesTemp = new XYChart.Series();

    private XYChart.Series seriesHumi = new XYChart.Series();

    private XYChart.Series seriesC02 = new XYChart.Series();

    private TimerTask lecture = new ReadTask();

    private JsonObject config;
    
    private HashMap<String, LineChart<Double, Double>> graphMap = new HashMap<>();
    
    private HashMap<CheckBox, TextField> dataValues = new HashMap<>();
    
    private HashMap<String, CheckBox> dataCheckboxes = new HashMap<>();
    
    private HashMap<String, String> dataGraph = new HashMap<>();

    @FXML
    private AnchorPane devicesAP;

    @FXML
    private ScrollPane devicesSP;

    int nextDeviceY = 0;
    
    @FXML
    private CheckBox activityCheckbox;

    @FXML
    private TextField activityValue;

    @FXML
    private CheckBox co2Checkbox;

    @FXML
    private TextField co2Value;

    @FXML
    private CheckBox humidityCheckbox;

    @FXML
    private TextField humidityValue;

    @FXML
    private CheckBox illuminationCheckbox;

    @FXML
    private TextField illuminationValue;

    @FXML
    private CheckBox infraredCheckbox;

    @FXML
    private TextField infraredValue;

    @FXML
    private CheckBox infraredAndVisibleCheckbox;

    @FXML
    private TextField infraredAndVisibleValue;

    @FXML
    private CheckBox pressureCheckbox;

    @FXML
    private TextField pressureValue;

    @FXML
    private CheckBox temperatureCheckbox;

    @FXML
    private TextField temperatureValue;

    @FXML
    private CheckBox tvocCheckbox;

    @FXML
    private TextField tvocValue;

    @FXML
    private TextField frequencyTF;
    
    @FXML
    private GridPane graphGrid;

	@Override
	public void initialize(URL location, ResourceBundle resources) {
		try {
			config = JsonParser.parseReader(new FileReader("src/config.json")).getAsJsonObject();
		} catch (Exception e) {
			System.out.println("Erreur lors du chargement de la configuration.");
			e.printStackTrace();
		}

		// Relie chaque donnée à sa CheckBox
		dataCheckboxes.put("activity", activityCheckbox);
		dataCheckboxes.put("co2", co2Checkbox);
		dataCheckboxes.put("humidity", humidityCheckbox);
		dataCheckboxes.put("illumination", illuminationCheckbox);
		dataCheckboxes.put("infrared", infraredCheckbox);
		dataCheckboxes.put("infrared_and_visible", infraredAndVisibleCheckbox);
		dataCheckboxes.put("pressure", pressureCheckbox);
		dataCheckboxes.put("temperature", temperatureCheckbox);
		dataCheckboxes.put("tvoc", tvocCheckbox);

		// Relie chaque CheckBox à son TextField
		dataValues.put(activityCheckbox, activityValue);
		dataValues.put(co2Checkbox, co2Value);
		dataValues.put(humidityCheckbox, humidityValue);
		dataValues.put(illuminationCheckbox, illuminationValue);
		dataValues.put(infraredCheckbox, infraredValue);
		dataValues.put(infraredAndVisibleCheckbox, infraredAndVisibleValue);
		dataValues.put(pressureCheckbox, pressureValue);
		dataValues.put(temperatureCheckbox, temperatureValue);
		dataValues.put(tvocCheckbox, tvocValue);

		// Relie chaque donnée à son nom sur les graphes
		dataGraph.put("activity", "Activité");
		dataGraph.put("co2", "CO2");
		dataGraph.put("humidity", "Humidité");
		dataGraph.put("illumination", "Éclairage");
		dataGraph.put("infrared", "Infrarouge (IR)");
		dataGraph.put("infrared_and_visible", "IR et visible");
		dataGraph.put("pressure", "Pression");
		dataGraph.put("temperature", "Temperature");
		dataGraph.put("tvoc", "TVOC");
		
		loadConfig();
	}

    private void loadConfig() {
    	// ici il faudra charger la config et modifier la vue par rapport à celle-ci
    	
    	int gridX = 0;
    	int gridY = 0;

    	JsonArray devices = config.getAsJsonArray("devices");
    	JsonArray dataWanted = config.getAsJsonArray("data_wanted");
    	JsonArray alertValues = config.getAsJsonArray("alert_values");
    	int frequency = config.get("frequency").getAsInt();

    	for (int i = 0; i < devices.size(); i ++) {
    		if (i == devices.size()-1) {
    			createNewDevice(null, devices.get(i).getAsString(), "+");
    		} else {
    			createNewDevice(null, devices.get(i).getAsString(), "-");
    		}
    	}

    	for (int i = 0; i < dataWanted.size(); i ++) {
    		CheckBox ckbx = dataCheckboxes.get(dataWanted.get(i).getAsString());
        	TextField txfd = dataValues.get(ckbx);
        	ckbx.setSelected(true);
        	txfd.setDisable(false);
        	txfd.setText(alertValues.get(i).getAsString());

        	NumberAxis xAxis = new NumberAxis("N° valeur", 1, 10, 5);
    		NumberAxis yAxis = new NumberAxis(dataGraph.get(dataWanted.get(i).getAsString()), 0, 150, 50);

    		LineChart<Double, Double> graph = new LineChart(xAxis, yAxis);
    		
    		graphMap.put(dataWanted.get(i).getAsString(), graph);

    		graphGrid.add(graph, gridX, gridY);
    		if (gridX == 2) {
    			gridY ++;
    			gridX = 0;
    		} else {
    			gridX ++;
    		}
    	}

    	frequencyTF.setText(String.valueOf(frequency));

		// Lecture répétée du fichier JSON
        new Timer().schedule(lecture, 0, frequency*60*1000);

        modifierGraphiques();
	}
    
    private void createNewDevice(ActionEvent event, String value, String button) {
    	TextField newTF = new TextField();
    	newTF.setText(value);
		newTF.setLayoutY(nextDeviceY);
		devicesAP.getChildren().add(newTF);
		Button newAddBT = new Button();
		newAddBT.setText(button);
		newAddBT.setLayoutX(149);
		newAddBT.setLayoutY(nextDeviceY);
		newAddBT.setOnAction( e -> createNewDevice(e, "", "+") );
		devicesAP.getChildren().add(newAddBT);
		nextDeviceY += 25;
		if (event != null) {
			((Button) event.getSource()).setText(" -");
			((Button) event.getSource()).setOnAction( e -> deleteDevice(e) );
		}
		devicesAP.setPrefHeight(nextDeviceY);
		devicesSP.setHmax(devicesAP.getPrefHeight());
    }
    
    private void deleteDevice(ActionEvent event) {
    	// reste à mettre à jour la position des autres objets pour qu'il n'y ait pas de trous
    	Button source = (Button) event.getSource();
    	for (int i = 0; i < devicesAP.getChildren().size(); i++) {
    		Node node = devicesAP.getChildren().get(i);
			if (node.getLayoutY() == source.getLayoutY()) {
				devicesAP.getChildren().remove(node);
				devicesAP.getChildren().remove(source);
				return;
			}
		}
    }

    //Modifie les graphiques
    private void modifierGraphiques() {
        // Titre des axes
        /*this.graph1.getYAxis().setLabel("Temps (minutes)");
        this.graph1.getXAxis().setLabel("Température");

        this.graph2.getYAxis().setLabel("Temps (minutes)");
        this.graph2.getXAxis().setLabel("Humidité");

        this.graph3.getYAxis().setLabel("Temps (minutes)");
        this.graph3.getXAxis().setLabel("Taux C02");

        // Séries de données
        this.seriesTemp.setName("Température en fonction du temps");
        this.seriesHumi.setName("Humidité en fonction du temps");
        this.seriesC02.setName("C02 en fonction du temps");

        // Ajout des séries aux graphiques
        this.graph1.getData().add(this.seriesTemp);
        this.graph2.getData().add(this.seriesHumi);
        this.graph3.getData().add(this.seriesC02);*/

    }

    // Ajout d'une nouvelle valeur de température
    public void addTemp(double d) {
        Calendar calendar = GregorianCalendar.getInstance();
        int min = calendar.get(Calendar.MINUTE);

        XYChart.Data donnee = new XYChart.Data(Math.random()*d, min);

        this.seriesTemp.getData().add(donnee);
    }

    // Ajout d'une nouvelle valeur d'humidité'
    public void addHumi(double d) {
        Calendar calendar = GregorianCalendar.getInstance();
        int min = calendar.get(Calendar.MINUTE);

        XYChart.Data donnee = new XYChart.Data(Math.random()*d, min);

        this.seriesHumi.getData().add(donnee);
    }

    // Ajout d'une nouvelle valeur de C02
    public void addCO2(double d) {
        Calendar calendar = GregorianCalendar.getInstance();
        int min = calendar.get(Calendar.MINUTE);

        XYChart.Data donnee = new XYChart.Data(Math.random()*d, min);

        this.seriesC02.getData().add(donnee);
    }

    // Classe qui lit les données du fichier JSON
    public class ReadTask extends TimerTask {
        public void run() {
            try {
                Reader rd = new FileReader("src/data.json");

                JsonObject jsObj = (JsonObject) JsonParser.parseReader(rd);

                double temp = jsObj.get("temperature").getAsDouble();
                double humi = jsObj.get("humidity").getAsDouble();
                double co2 = jsObj.get("co2").getAsDouble();

                // System.out.println("Température: " + temp);
                // System.out.println("Humidité: " + humi);
                // System.out.println("CO2: " + co2);

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

    @FXML
    private void saveConfig() {
    	try {
	    	Gson gson = new GsonBuilder().setPrettyPrinting().disableHtmlEscaping().create();
	
	    	File file = new File("config.json");
	
			FileOutputStream out = new FileOutputStream(file);
			out.write(gson.toJson(config).getBytes());
			out.close();
    	} catch (IOException e) {
    		e.printStackTrace();
    	}
    	// recharge la configuration pour prendre en compte les changements
    	loadConfig();
    }
    
    @FXML
    private void onActionCheckBox(ActionEvent event) {
    	CheckBox ckbx = (CheckBox) event.getSource();
    	TextField txfd = dataValues.get(ckbx);
		if (ckbx.isSelected()) {
			txfd.setDisable(false);
			txfd.setText("0");
		} else {
			txfd.setDisable(true);
			txfd.setText("");
		}
    }
}