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

	private TimerTask lecture = new UpdateChart();

    private JsonObject config;
    
    private HashMap<String, LineChart<Double, Double>> dataChart = new HashMap<>();

    private HashMap<String, String> dataGraphName = new HashMap<>();

    private HashMap<String, XYChart.Series<Double, Double>> dataSeries = new HashMap<>();
    
    private HashMap<CheckBox, TextField> dataTextField = new HashMap<>();
    
    private HashMap<String, CheckBox> dataCheckbox = new HashMap<>();

    @FXML
    private AnchorPane devicesAP;

    @FXML
    private ScrollPane devicesSP;

    int nextDeviceY = 0;
    
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
		try {
			config = JsonParser.parseReader(new FileReader("config.json")).getAsJsonObject();
		} catch (Exception e) {
			System.out.println("Erreur lors du chargement de la configuration.");
			e.printStackTrace();
		}

		// Relie chaque donnée à sa CheckBox
		dataCheckbox.put("activity", activityCB);
		dataCheckbox.put("co2", co2CB);
		dataCheckbox.put("humidity", humidityCB);
		dataCheckbox.put("illumination", illuminationCB);
		dataCheckbox.put("infrared", infraredCB);
		dataCheckbox.put("infrared_and_visible", infraredAndVisibleCB);
		dataCheckbox.put("pressure", pressureCB);
		dataCheckbox.put("temperature", temperatureCB);
		dataCheckbox.put("tvoc", tvocCB);

		// Relie chaque CheckBox à son TextField
		dataTextField.put(activityCB, activityV);
		dataTextField.put(co2CB, co2V);
		dataTextField.put(humidityCB, humidityV);
		dataTextField.put(illuminationCB, illuminationV);
		dataTextField.put(infraredCB, infraredV);
		dataTextField.put(infraredAndVisibleCB, infraredAndVisibleV);
		dataTextField.put(pressureCB, pressureV);
		dataTextField.put(temperatureCB, temperatureV);
		dataTextField.put(tvocCB, tvocV);

		// Relie chaque donnée à son nom sur les graphes
		dataGraphName.put("activity", "Activité");
		dataGraphName.put("co2", "CO2");
		dataGraphName.put("humidity", "Humidité");
		dataGraphName.put("illumination", "Éclairage");
		dataGraphName.put("infrared", "Infrarouge (IR)");
		dataGraphName.put("infrared_and_visible", "IR et visible");
		dataGraphName.put("pressure", "Pression");
		dataGraphName.put("temperature", "Temperature");
		dataGraphName.put("tvoc", "TVOC");
		
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
    		CheckBox ckbx = dataCheckbox.get(dataWanted.get(i).getAsString());
        	TextField txfd = dataTextField.get(ckbx);
        	ckbx.setSelected(true);
        	txfd.setDisable(false);
        	txfd.setText(alertValues.get(i).getAsString());

        	NumberAxis xAxis = new NumberAxis();
        	xAxis.setLabel("N° valeur");
    		NumberAxis yAxis = new NumberAxis();
    		yAxis.setLabel(dataGraphName.get(dataWanted.get(i).getAsString()));

    		LineChart<Double, Double> graph = new LineChart(xAxis, yAxis);

    		XYChart.Series<Double, Double> series = new XYChart.Series<Double, Double>();

    		graph.getData().add(series);
    		
    		dataSeries.put(dataWanted.get(i).getAsString(), series);

    		dataChart.put(dataWanted.get(i).getAsString(), graph);

    		graphGP.add(graph, gridX, gridY);
    		if (gridX == 2) {
    			gridY ++;
    			gridX = 0;
    		} else {
    			gridX ++;
    		}
    	}

    	frequencyV.setText(String.valueOf(frequency));

		// Lecture répétée du fichier JSON
    	if (frequency == 0) {
    		new Timer().schedule(lecture, 0, 30*1000);
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

    // Classe qui met � jour les graphiques en fonction du fichier JSON
    public class UpdateChart extends TimerTask {
        public void run() {
            try {
                Reader dataFileReader = new FileReader("data.json");

                JsonObject jsObj = (JsonObject) JsonParser.parseReader(dataFileReader);

            	for (String dataName : jsObj.keySet()) {
            		if (dataSeries.containsKey(dataName)) {
	            		XYChart.Series<Double, Double> series = dataSeries.get(dataName);

	            		double valeur = jsObj.get(dataName).getAsDouble();

	            		int num = series.getData().size();

	                    series.getData().add(new XYChart.Data(num, valeur));
            		}
            	}
            } catch (Exception e) {
            	System.out.println("Erreur lors de la mise � jour des graphiques.");
                e.printStackTrace();
            }
        }
    }

    public void arretLecture() {
        lecture.cancel();
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
    	for (Entry<String, CheckBox> me : dataCheckbox.entrySet()) {
    		if (me.getValue().isSelected()) {
    			data_wanted.add(me.getKey());
    			alert_values.add(new JsonPrimitive(Integer.valueOf(dataTextField.get(me.getValue()).getText())));
    		}
    	}
    	
    	// frequency
    	int frequency;
    	if (frequencyV.getText().equals("")) {
    		frequencyV.setText("0");
    		frequency = 0;
    	} else {
    		frequency = Integer.valueOf(frequencyV.getText());
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
    	TextField txfd = dataTextField.get(ckbx);
		if (ckbx.isSelected()) {
			txfd.setDisable(false);
			txfd.setText("0");
		} else {
			txfd.setDisable(true);
			txfd.setText("");
		}
    }
}
