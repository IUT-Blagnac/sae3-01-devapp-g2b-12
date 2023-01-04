package view;

import javafx.scene.Cursor;
import javafx.scene.control.Label;
import javafx.scene.layout.StackPane;

/**
 * Classe pour afficher la valeur d'un point lorsqu'on le survol
 * @author R�my Guibert
 */
public class HoveredThresholdNode extends StackPane {

	/**
	 * Cr�er un Label qui sera affich� lorsqu'on survole le point
	 * et ne sera plus visible dans les autres cas
	 * @param value Valeur a afficher
	 */
	public HoveredThresholdNode(double value) {
		// taille du point
		setPrefSize(10, 10);

		// Label � afficher
		Label label = createLabel(value);

		// affiche le Label lorsqu'on survole le point
		setOnMouseEntered( event -> {
			getChildren().setAll(label);
			setCursor(Cursor.NONE);
			toFront();
		});

		// fait dispara�tre le Label lorsque la souris s'�loigne du point
		setOnMouseExited( event -> getChildren().clear() );
	}

	/**
	 * Retourne un Label avec une valeur donn�e et un contour
	 * @param value
	 * @return le Label cr��
	 */
	private Label createLabel(double value) {
		Label label = new Label(value + "");
		label.getStyleClass().addAll("chart-line-symbol");
		label.setMinSize(Label.USE_PREF_SIZE, Label.USE_PREF_SIZE);
		return label;
	}
}
