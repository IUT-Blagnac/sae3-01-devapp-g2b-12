package view;

import javafx.application.Platform;
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

	private TimerTask lecture = new UpdateChart();

    private JsonObject config;
    
    private HashMap<Integer, LineChart<Double, Double>> graphMap = new HashMap<>();

    private HashMap<Integer, XYChart.Series<Double, Double>> graphSeries = new HashMap<>();
    
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
			config = JsonParser.parseReader(new FileReader("config.json")).getAsJsonObject();
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

    		XYChart.Series<Double, Double> series = new XYChart.Series<Double, Double>();

    		graph.getData().add(series);

    		graphSeries.put(i, series); // TODO CHNAGER OHLA

    		graphMap.put(i, graph);

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
    	if (frequency == 0) {
    		new Timer().schedule(lecture, 0, 5*1000);
    	} else {
    		new Timer().schedule(lecture, 0, frequency*60*1000);
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

    // Classe qui lit les données du fichier JSON
    public class UpdateChart extends TimerTask {
        public void run() {
            try {
            	System.out.println("-----lecture-----");

                Reader frd = new FileReader("data.json");

                JsonObject jsObj = (JsonObject) JsonParser.parseReader(frd);

                Platform.runLater(() -> {
                	System.out.println("-----chose-----");
                	for (int i = 0; i < graphSeries.size(); i ++) {
                		XYChart.Series<Double, Double> series = graphSeries.get(i);

	                    series.getData().add(new XYChart.Data(series.getData().size()+1, 100));
                	}
                });

            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }

    public void arretLecture(){
        lecture.cancel();
        System.out.println("-----fin lecture-----");
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
    	
    	// data
    	config.add("data_wanted", new JsonArray());
    	config.add("alert_values", new JsonArray());
    	JsonArray data_wanted = config.getAsJsonArray("data_wanted");
    	JsonArray alert_values = config.getAsJsonArray("alert_values");
    	for (Entry<String, CheckBox> me : dataCheckboxes.entrySet()) {
    		if (me.getValue().isSelected()) {
    			data_wanted.add(me.getKey());
    			alert_values.add(dataValues.get(me.getValue()).getText());
    		}
    	}
    	
    	// frequency
    	int frequency;
    	if (frequencyTF.getText().equals("")) {
    		frequencyTF.setText("0");
    		frequency = 0;
    	} else {
    		frequency = Integer.valueOf(frequencyTF.getText());
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

			message = "La configuration a bien �t� enregistr�e.\nElle sera effective au prochain d�marrage.";
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
