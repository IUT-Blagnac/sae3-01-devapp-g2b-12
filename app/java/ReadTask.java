import java.util.TimerTask;
import java.io.*;
import java.util.*;
import org.json.simple.*;
import org.json.simple.parser.*;

public class ReadTask extends TimerTask {

    public void run(){
        JSONParser parser = new JSONParser();

        try{
            Reader rd = new FileReader("d:\\SAE\\test.json");

            JSONObject jsObj = (JSONObject) parser.parse(rd);
            //System.out.println(jsObj);

            long temp = (Long) jsObj.get("temperature");
            long humi = (Long) jsObj.get("humidite");
            long co2 = (Long) jsObj.get("co2");

            System.out.println("Température: " + temp);
            System.out.println("Humidité: " + humi);
            System.out.println("CO2: " + co2);
        }
        catch(Exception e){
            e.printStackTrace();
        }
    }
}
