package view;

import javafx.scene.Cursor;
import javafx.scene.control.Label;
import javafx.scene.layout.StackPane;

/**
 * Classe pour afficher la valeur d'un point lorsqu'on le survole
 * @author Rémy Guibert
 */
public class HoveredThresholdNode extends StackPane {

	/**
	 * Créer un Label qui sera affiché lorsqu'on survole le point
	 * et ne sera plus visible dans les autres cas
	 * @param value Valeur a afficher
	 */
	public HoveredThresholdNode(double value) {
		// taille du point
		setPrefSize(10, 10);

		// Label à afficher
		Label label = createLabel(value);

		// affiche le Label lorsqu'on survole le point
		setOnMouseEntered( event -> {
			getChildren().setAll(label);
			setCursor(Cursor.NONE);
			toFront();
		});

		// fait disparaître le Label lorsque la souris s'éloigne du point
		setOnMouseExited( event -> getChildren().clear() );
	}

	/**
	 * Retourne un Label avec une valeur donnée et un contour
	 * @param value
	 * @return le Label créé
	 */
	private Label createLabel(double value) {
		Label label = new Label(value + "");
		label.getStyleClass().addAll("chart-line-symbol");
		label.setMinSize(Label.USE_PREF_SIZE, Label.USE_PREF_SIZE);
		return label;
	}

}