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
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.IOException;
import java.net.URL;
import java.util.*;
import java.util.Map.Entry;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.google.gson.JsonParser;
import com.google.gson.JsonPrimitive;

/**
 * Classe contrôleur gérant la seule page de l'application
 * @author Rémy Guibert
 */
public class MainPageController implements Initializable {

	/**
	 * Objet qui s'occupe de la màj des graphiques en parallèle
	 */
	private TimerTask chartUpdater = new ChartUpdater();

	/**
	 * Planificateur de l'objet qui met à jour les graphiques
	 */
	private Timer scheduler = new Timer();

	/**
	 * Objet JSON qui contient la configuration
	 */
    private JsonObject config;

    /**
     * Map reliant le nom technique des données à leurs graphiques
     */
    private HashMap<String, LineChart<Integer, Double>> dataChart = new HashMap<>();

    /**
     * Map reliant le nom technique des données aux noms à afficher sur les graphiques
     */
    private HashMap<String, String> dataChartName = new HashMap<>();

    /**
     * Map reliant le nom technique des données à leurs liste de valeurs du graphiques
     */
    private HashMap<String, XYChart.Series<Integer, Double>> dataSeries = new HashMap<>();

    /**
     * Map reliant le nom technique des données à leurs CheckBox respectives
     */
    private HashMap<String, CheckBox> dataCB = new HashMap<>();

    /**
     * Map reliant les CheckBox des données à leurs TextField
     */
    private HashMap<CheckBox, TextField> dataCBtoTF = new HashMap<>();

    /**
     * Hauteur Y en pixel à laquelle doit être créer la prochaine entrée de "Device"
     * voir createNewDevice() et deleteDevice()
     */
    private int nextDeviceY = 0;

    @FXML
    private AnchorPane devicesAP;

    @FXML
    private ScrollPane devicesSP;

    @FXML
    private CheckBox tvocCB;

    @FXML
    private TextField tvocV;

    @FXML
    private CheckBox activityCB;

    @FXML
    private TextField activityV;

    @FXML
    private CheckBox illuminationCB;

    @FXML
    private TextField illuminationV;

    @FXML
    private CheckBox co2CB;

    @FXML
    private TextField co2V;

    @FXML
    private CheckBox temperatureCB;

    @FXML
    private TextField temperatureV;

    @FXML
    private CheckBox humidityCB;

    @FXML
    private TextField humidityV;

    @FXML
    private CheckBox infraredAndVisibleCB;

    @FXML
    private TextField infraredAndVisibleV;

    @FXML
    private CheckBox infraredCB;

    @FXML
    private TextField infraredV;

    @FXML
    private CheckBox pressureCB;

    @FXML
    private TextField pressureV;

    @FXML
    private TextField frequencyV;

    @FXML
    private TextField hostV;

    @FXML
    private TextField portV;
    
    @FXML
    private GridPane graphGP;

	/**
	 * Initialise les maps et la configuration
	 */
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

		// charge la configuration dans l'interface
		loadConfig();
	}

    /**
     * Charge la configuration dans l'interface, et planifi la mise à jour des graphiques
     */
    private void loadConfig() {
    	// lit la configuration
		try {
			config = JsonParser.parseReader(new FileReader("config.json")).getAsJsonObject();
		} catch (FileNotFoundException e) {
			// affiche un message d'information
			System.out.println("Fichier \"config.json\" introuvable, impossible de charger la configuration.");
	    	Alert alert = new Alert(AlertType.INFORMATION);
	    	alert.setTitle("Pas de configuration");
	    	alert.setHeaderText("Aucun fichier de configuration à charger.");
	    	alert.setContentText("Vous pouvez en générer un en appuyant sur 'Enregistrer'.");
	    	alert.showAndWait();
	    	createDevice(null, "", "+");
			return;
		}

    	// charge les paramètres
    	JsonArray devices = config.getAsJsonArray("devices");
    	JsonArray dataWanted = config.getAsJsonArray("data_wanted");
    	JsonArray alertValues = config.getAsJsonArray("alert_values");
    	int frequency = config.get("frequency").getAsInt();
    	String host = config.get("host").getAsString();
    	int port = config.get("port").getAsInt();

    	// devices
    	for (int i = 0; i < devices.size(); i ++) {
    		if (i == devices.size()-1) {
    			createDevice(null, devices.get(i).getAsString(), "+");
    		} else {
    			createDevice(null, devices.get(i).getAsString(), " -");
    		}
    	}

    	// pour savoir où mettre les graphiques
    	int gridX = 0;
    	int gridY = 0;

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

    		@SuppressWarnings({ "unchecked", "rawtypes" })
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

    	// host
    	hostV.setText(String.valueOf(host));

    	// port
    	portV.setText(String.valueOf(port));

		// Lecture répétée du fichier JSON, toutes les 45 secondes si la fréquence est à 0
    	if (frequency == 0) {
    		scheduler.schedule(chartUpdater, 0, 45*1000);
    	} else {
    		scheduler.schedule(chartUpdater, 0, frequency*60*1000);
    	}
	}

    /**
     * Sauvegarde la configuration dans le fichier JSON
     */
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
					try  {
						alert_values.add(new JsonPrimitive(Double.valueOf(dataTF.getText())));
					} catch (Exception e2) {
						alert_values.add(0);
						dataTF.setText("0");
					}
				}
    		}
    	}
    	if (data_wanted.size() == 0) {
    		for (String me : dataCB.keySet()) {
        		data_wanted.add(me);
        		alert_values.add(0);
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
    	String host = hostV.getText();
    	if (host.equals("")) {
    		host = "chirpstack.iut-blagnac.fr";
    		//hostV.setText(host);
    	}
    	config.add("host", new JsonPrimitive(host));

    	// port
    	int port;
    	if (portV.getText().equals("")) {
    		portV.setText("1883");
    	}
    	try {
    		port = Integer.valueOf(portV.getText());
		} catch (Exception e) {
			port = 1883;
			portV.setText("1883");
		}
    	config.add("port", new JsonPrimitive(port));

    	String message;
    	AlertType type;

    	// enregistre la configuration
    	try {
	    	Gson gson = new GsonBuilder().setPrettyPrinting().disableHtmlEscaping().create();

	    	File file = new File("config.json");

			FileOutputStream out = new FileOutputStream(file);
			out.write(gson.toJson(config).getBytes());
			out.close();

			message = "La configuration a bien été enregistrée.";
			type = AlertType.INFORMATION;
    	} catch (IOException e) {
    		e.printStackTrace();
    		message = "Une erreur est survenue lors de l'enregistrement.";
    		type = AlertType.ERROR;
    	}

    	// affiche un message de confirmation/erreur
    	Alert alert = new Alert(type);
    	alert.setTitle("Enregistrement");
    	alert.setHeaderText(message);
    	alert.showAndWait();

    	// actualise la vue
    	clearVue();
		loadConfig();
    }

    /**
     * Réinitialise la vue et les données enregistrées
     */
    private void clearVue() {
    	// graphiques
    	dataSeries.clear();
    	graphGP.getChildren().clear();

    	// séries
    	dataChart.clear();

    	// devices
    	nextDeviceY = 0;

    	// data wanted + alert values
    	devicesAP.getChildren().clear();
    	tvocCB.setSelected(false);
    	activityCB.setSelected(false);
    	illuminationCB.setSelected(false);
    	co2CB.setSelected(false);
    	temperatureCB.setSelected(false);
    	humidityCB.setSelected(false);
    	infraredAndVisibleCB.setSelected(false);
    	infraredCB.setSelected(false);
    	pressureCB.setSelected(false);

    	// frequency
    	frequencyV.setText("");

    	// host
    	hostV.setText("");

    	// port
    	portV.setText("");

    	// task
    	chartUpdater.cancel();
    	chartUpdater = new ChartUpdater();
	}

    /**
     * Ajoute un nouveau TextField et Button dans la lise des capteurs
     * @param event Événement déclancheur de l'appel, peut être null
     * @param value Valeur du TextField lors de la création
     * @param button Valeur du Button lors de la création
     */
    private void createDevice(ActionEvent event, String value, String button) {
    	// création du TextField
    	TextField newTF = new TextField();
    	newTF.setText(value);
		newTF.setLayoutY(nextDeviceY);
		// création du Button
		Button newAddBT = new Button();
		newAddBT.setText(button);
		newAddBT.setLayoutX(149);
		newAddBT.setLayoutY(nextDeviceY);
		// type de bouton
		if (button == " -") {
			newAddBT.setOnAction( e -> deleteDevice(e) );
		} else {
			newAddBT.setOnAction( e -> createDevice(e, "", "+") );
		}
		// ajout dans la liste des capteurs
		devicesAP.getChildren().add(newTF);
		devicesAP.getChildren().add(newAddBT);
		// change le texte du bouton appellant
		if (event != null) {
			Button source = (Button) event.getSource();
			source.setText(" -");
			source.setOnAction( e -> deleteDevice(e) );
		}
		// augmente la hauteur Y en pixel à laquelle sera créer le prochain capteur
		nextDeviceY += 25;
		// adapte l'AnchorPane et le ScrollPane à la nouvelle hauteur
		devicesAP.setPrefHeight(nextDeviceY);
		devicesSP.setHmax(devicesAP.getPrefHeight());
    }

    /**
     * Supprime une entrée de la liste de capteurs
     * @param event Événement déclancheur de l'appel
     */
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
    	// réduit la hauteur Y en pixel à laquelle sera créer le prochain capteur
    	nextDeviceY -= 25;
    	// adapte l'AnchorPane et le ScrollPane à la nouvelle hauteur
		devicesAP.setPrefHeight(nextDeviceY);
		devicesSP.setHmax(devicesAP.getPrefHeight());
    }

	/**
     * Déclenché lors d'une action sur une CheckBox
     * Gère le TextField associé à celui-ci
     * @param event
     */
    @FXML
    private void onActionCheckBox(ActionEvent event) {
    	// récupère la CheckBox déclencheur
    	CheckBox dataCB = (CheckBox) event.getSource();
    	// récupère le TextField
    	TextField dataTF = dataCBtoTF.get(dataCB);
    	// affiche ou pas le TextField en fonctione de l'état de la CheckBox
    	if (dataCB.isSelected()) {
			dataTF.setDisable(false);
			dataTF.setText("0");
		} else {
			dataTF.setDisable(true);
			dataTF.setText("");
		}
    }

    /**
     * Classe qui permet de mettre à jour les graphiques en fonction du fichier JSON "data.json"
     */
    private class ChartUpdater extends TimerTask {
        public void run() {
            try {
            	// lit le fichier de données
                JsonObject jsonData = JsonParser.parseReader(new FileReader("data.json")).getAsJsonObject();

            	for (String dataName : jsonData.keySet()) {
            		if (dataSeries.containsKey(dataName)) {
	            		// extrait la nouvelle valeur
	            		double newValue = jsonData.get(dataName).getAsDouble();

	            		// récupère la bonne série
	            		XYChart.Series<Integer, Double> series = dataSeries.get(dataName);

	            		// ajoute la nouvelle valeur à la série
	            		int newX = series.getData().size();
	            		XYChart.Data<Integer, Double> newData = new XYChart.Data<Integer, Double>(newX, newValue);
	            		newData.setNode(new HoveredThresholdNode(newValue));
	            		Platform.runLater( () -> series.getData().add(newData) );
            		}
            	}
            } catch (Exception e) {
            	System.out.println("Fichier \"data.json\" introuvable, impossible de mettre à jour les graphiques.");
            }
        }
    }

    /**
     * Met fin à la planification afin d'arrêter les Threads et de fermer l'application
     */
    public void cancelScheduling() {
        chartUpdater.cancel();
        scheduler.cancel();
    }

}