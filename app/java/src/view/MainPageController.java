package view;

import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.Node;
import javafx.scene.chart.LineChart;
import javafx.scene.chart.NumberAxis;
import javafx.scene.chart.XYChart;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
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
import java.util.Map.Entry;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.google.gson.JsonParser;
import com.google.gson.JsonPrimitive;

public class MainPageController implements Initializable {

	private TimerTask chartUpdater = new ChartUpdater();

	private Timer scheduler = new Timer();

    private JsonObject config;
    
    private HashMap<String, LineChart<Integer, Double>> dataChart = new HashMap<>();

    private HashMap<String, String> dataChartName = new HashMap<>();

    private HashMap<String, XYChart.Series<Integer, Double>> dataSeries = new HashMap<>();
    
    private HashMap<String, CheckBox> dataCB = new HashMap<>();

    private HashMap<CheckBox, TextField> dataCBtoTF = new HashMap<>();

    @FXML
    private AnchorPane devicesAP;

    @FXML
    private ScrollPane devicesSP;

    private int nextDeviceY = 0;
    
    @FXML
    private CheckBox activityCB;

    @FXML
    private TextField activityV;

    @FXML
    private CheckBox co2CB;

    @FXML
    private TextField co2V;

    @FXML
    private CheckBox humidityCB;

    @FXML
    private TextField humidityV;

    @FXML
    private CheckBox illuminationCB;

    @FXML
    private TextField illuminationV;

    @FXML
    private CheckBox infraredCB;

    @FXML
    private TextField infraredV;

    @FXML
    private CheckBox infraredAndVisibleCB;

    @FXML
    private TextField infraredAndVisibleV;

    @FXML
    private CheckBox pressureCB;

    @FXML
    private TextField pressureV;

    @FXML
    private CheckBox temperatureCB;

    @FXML
    private TextField temperatureV;

    @FXML
    private CheckBox tvocCB;

    @FXML
    private TextField tvocV;

    @FXML
    private TextField frequencyV;
    
    @FXML
    private GridPane graphGP;

	@Override
	public void initialize(URL location, ResourceBundle resources) {
		// Relie chaque donnée à sa CheckBox
		dataCB.put("activity", activityCB);
		dataCB.put("co2", co2CB);
		dataCB.put("humidity", humidityCB);
		dataCB.put("illumination", illuminationCB);
		dataCB.put("infrared", infraredCB);
		dataCB.put("infrared_and_visible", infraredAndVisibleCB);
		dataCB.put("pressure", pressureCB);
		dataCB.put("temperature", temperatureCB);
		dataCB.put("tvoc", tvocCB);

		// Relie chaque CheckBox à son TextField
		dataCBtoTF.put(activityCB, activityV);
		dataCBtoTF.put(co2CB, co2V);
		dataCBtoTF.put(humidityCB, humidityV);
		dataCBtoTF.put(illuminationCB, illuminationV);
		dataCBtoTF.put(infraredCB, infraredV);
		dataCBtoTF.put(infraredAndVisibleCB, infraredAndVisibleV);
		dataCBtoTF.put(pressureCB, pressureV);
		dataCBtoTF.put(temperatureCB, temperatureV);
		dataCBtoTF.put(tvocCB, tvocV);

		// Relie chaque donnée à son nom sur les graphes
		dataChartName.put("activity", "Activité");
		dataChartName.put("co2", "CO2");
		dataChartName.put("humidity", "Humidité");
		dataChartName.put("illumination", "Éclairage");
		dataChartName.put("infrared", "Infrarouge (IR)");
		dataChartName.put("infrared_and_visible", "IR et visible");
		dataChartName.put("pressure", "Pression");
		dataChartName.put("temperature", "Temperature");
		dataChartName.put("tvoc", "TVOC");

		try {
			config = JsonParser.parseReader(new FileReader("config.json")).getAsJsonObject();
			loadConfig();
		} catch (Exception e) {
			System.out.println("Erreur lors du chargement de la configuration, fichier config.json inexistant ou autre problème.");
			e.printStackTrace();
		}
	}

    private void loadConfig() {
    	int gridX = 0;
    	int gridY = 0;

    	JsonArray devices = config.getAsJsonArray("devices");
    	JsonArray dataWanted = config.getAsJsonArray("data_wanted");
    	JsonArray alertValues = config.getAsJsonArray("alert_values");
    	int frequency = config.get("frequency").getAsInt();

    	// devices
    	for (int i = 0; i < devices.size(); i ++) {
    		if (i == devices.size()-1) {
    			createNewDevice(null, devices.get(i).getAsString(), "+");
    		} else {
    			createNewDevice(null, devices.get(i).getAsString(), "-");
    		}
    	}

    	// data wanted + alert values
    	for (int i = 0; i < dataWanted.size(); i ++) {
    		CheckBox ckbx = dataCB.get(dataWanted.get(i).getAsString());
        	TextField txfd = dataCBtoTF.get(ckbx);
        	ckbx.setSelected(true);
        	txfd.setDisable(false);
        	txfd.setText(alertValues.get(i).getAsString());

        	NumberAxis xAxis = new NumberAxis();
        	xAxis.setLabel("N° valeur");
    		NumberAxis yAxis = new NumberAxis();
    		yAxis.setLabel(dataChartName.get(dataWanted.get(i).getAsString()));

    		LineChart<Integer, Double> graph = new LineChart(xAxis, yAxis);

    		XYChart.Series<Integer, Double> series = new XYChart.Series<Integer, Double>();

    		graph.getData().add(series);

    		dataChart.put(dataWanted.get(i).getAsString(), graph);

    		dataSeries.put(dataWanted.get(i).getAsString(), series);

    		graphGP.add(graph, gridX, gridY);
    		if (gridX == 2) {
    			gridY ++;
    			gridX = 0;
    		} else {
    			gridX ++;
    		}
    	}

    	// frequency
    	frequencyV.setText(String.valueOf(frequency));

		// Lecture répétée du fichier JSON, toutes les 30 secondes si la fréquence est à 0
    	if (frequency == 0) {
    		scheduler.schedule(chartUpdater, 0, 30*1000);
    	} else {
    		scheduler.schedule(chartUpdater, 0, frequency*60*1000);
    	}
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
    	// supprime le bouton déclencheur et le TextField correspondant
    	Button source = (Button) event.getSource();
    	int indexBT = devicesAP.getChildren().indexOf(source);
    	devicesAP.getChildren().remove(indexBT);
    	devicesAP.getChildren().remove(indexBT-1);
    	
    	// décalle le reste des éléments pour ne laisser aucun trous
    	int layoutY = 0;
    	for (int i = 0; i < devicesAP.getChildren().size(); i += 2) {
    		Node nodeTF = devicesAP.getChildren().get(i);
    		Node nodeBT = devicesAP.getChildren().get(i+1);
			if (nodeTF.getLayoutY()-layoutY == 25) {
				nodeTF.setLayoutY(layoutY);
				nodeBT.setLayoutY(layoutY);
			}
			layoutY += 25;
		}
    	nextDeviceY -= 25;
		devicesAP.setPrefHeight(nextDeviceY);
		devicesSP.setHmax(devicesAP.getPrefHeight());
    }

    // Classe qui permet de mettre à jour les graphiques en fonction du fichier JSON
    public class ChartUpdater extends TimerTask {
        public void run() {
            try {
            	// lit le fichier des données
                Reader dataFileReader = new FileReader("data.json");
                JsonObject jsObj = (JsonObject) JsonParser.parseReader(dataFileReader);
                // pour chaque donnée
            	for (String dataName : jsObj.keySet()) {
            		if (dataSeries.containsKey(dataName)) {
	            		// extrait la valeur
	            		double valeur = jsObj.get(dataName).getAsDouble();

	            		// l'ajoute au bon graphique
	            		XYChart.Series<Integer, Double> series = dataSeries.get(dataName);
	            		int numValue = series.getData().size();
	                    series.getData().add(new XYChart.Data<Integer, Double>(numValue, valeur));
            		}
            	}
            } catch (Exception e) {
            	System.out.println("Erreur lors de la mise à jour des graphiques :");
                e.printStackTrace();
            }
        }
    }

    public void arretLecture() {
        chartUpdater.cancel();
        scheduler.cancel();
    }

    @FXML
    private void saveConfig() {
    	JsonObject config = new JsonObject();
    	config.add("devices", new JsonArray());

    	// devices
    	JsonArray devices = config.getAsJsonArray("devices");
    	TextField device;
    	for (int i = 0; i < devicesAP.getChildren().size(); i += 2) {
    		device = (TextField) devicesAP.getChildren().get(i);
    		if (!device.getText().equals("")) {
    			devices.add(device.getText());
    		}
    	}
    	if (devices.size() == 0) {
    		devices.add("#");
    		device = (TextField) devicesAP.getChildren().get(0);
    		device.setText("#");
    	}
    	
    	// data wanted + alert values
    	config.add("data_wanted", new JsonArray());
    	config.add("alert_values", new JsonArray());
    	JsonArray data_wanted = config.getAsJsonArray("data_wanted");
    	JsonArray alert_values = config.getAsJsonArray("alert_values");
    	for (Entry<String, CheckBox> me : dataCB.entrySet()) {
    		if (me.getValue().isSelected()) {
    			data_wanted.add(me.getKey());
    			TextField dataTF = dataCBtoTF.get(me.getValue());
    			if (dataTF.getText().equals("")) {
    				dataTF.setText("0");
    			}
    			try {
    				alert_values.add(new JsonPrimitive(Integer.valueOf(dataTF.getText())));
				} catch (Exception e) {
					alert_values.add(new JsonPrimitive(Double.valueOf(dataTF.getText())));
				}
    		}
    	}
    	
    	// frequency
    	int frequency;
    	if (frequencyV.getText().equals("")) {
    		frequencyV.setText("10");
    	}
    	try {
    		frequency = Integer.valueOf(frequencyV.getText());
		} catch (Exception e) {
			frequency = 10;
			frequencyV.setText("10");
		}
    	config.add("frequency", new JsonPrimitive(frequency));

    	// host
    	config.add("host", new JsonPrimitive("chirpstack.iut-blagnac.fr"));
    	// port
    	config.add("port", new JsonPrimitive(1883));

    	String message;
    	AlertType type;

    	try {
	    	Gson gson = new GsonBuilder().setPrettyPrinting().disableHtmlEscaping().create();

	    	File file = new File("config.json");

			FileOutputStream out = new FileOutputStream(file);
			out.write(gson.toJson(config).getBytes());
			out.close();

			message = "La configuration a bien été enregistrée.\nElle sera effective au prochain démarrage.";
			type = AlertType.INFORMATION;
    	} catch (IOException e) {
    		e.printStackTrace();
    		message = "Une erreur est survenue lors de l'enregistrement.";
    		type = AlertType.ERROR;
    	}

    	Alert alert = new Alert(type);
    	alert.setTitle("Enregistrement");
    	alert.setHeaderText(message);
    	alert.showAndWait();
    }

    @FXML
    private void onActionCheckBox(ActionEvent event) {
    	CheckBox ckbx = (CheckBox) event.getSource();
    	TextField txfd = dataCBtoTF.get(ckbx);
		if (ckbx.isSelected()) {
			txfd.setDisable(false);
			txfd.setText("0");
		} else {
			txfd.setDisable(true);
			txfd.setText("");
		}
    }
}
