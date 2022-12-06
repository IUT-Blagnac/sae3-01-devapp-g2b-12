import java.io.*;
import java.util.*;
import org.json.simple.*;
import org.json.simple.parser.*;

public class Main {
    public static void main(String[] args) {
        new Timer().schedule(new ReadTask(), 0, 10000);
    }


}