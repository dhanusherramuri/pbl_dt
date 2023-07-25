import org.w3c.dom.*;
import javax.xml.parsers.*;
import java.util.Scanner;
import java.io.*;


public class DOMParserDemo {
    public static void main(String[] args) throws Exception {
        DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
        DocumentBuilder builder = factory.newDocumentBuilder();

        Document doc = builder.parse("students.xml");

        NodeList list = doc.getElementsByTagName("student");
        Scanner in = new Scanner(System.in);
        System.out.print("Enter student ID:\t");
        int n = in.nextInt();
        int flag = 0;
        for (int i = 0; i < list.getLength(); i++) {
            Node node = list.item(i);
            if (node.getNodeType() == Node.ELEMENT_NODE) {
                Element e = (Element) node;
                int x = Integer.parseInt(e.getElementsByTagName("studentid").item(0).getTextContent());
                if (x == n) {
                    System.out.println("\n\n STUDENT-DETAILS");
                    System.out.println("===================");
                    System.out.println("student id :\t" + e.getElementsByTagName("studentid").item(0).getTextContent());
                    System.out.println("student Name :\t" + e.getElementsByTagName("name").item(0).getTextContent());
                    System.out.println("Adress :\t" + e.getElementsByTagName("address").item(0).getTextContent());
                    System.out.println("Gender :\t" + e.getElementsByTagName("gender").item(0).getTextContent());
                    flag = 1;
                    break;
                } else {
                    flag = 0;
                }
            }
        }
        if (flag == 0)
            System.out.println("student Id is not present.Try Again!!!");
    }
}