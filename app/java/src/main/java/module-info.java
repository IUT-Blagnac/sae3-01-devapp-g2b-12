module com.example.demo {
    requires javafx.controls;
    requires javafx.fxml;
    requires json.simple;


    opens com.example.demo to javafx.fxml;
    exports com.example.demo;
}