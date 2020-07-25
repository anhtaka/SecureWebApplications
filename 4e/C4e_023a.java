import java.io.IOException;
import java.io.PrintWriter;
import java.io.StringReader;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import org.apache.commons.lang3.StringEscapeUtils;

import org.w3c.dom.Document;
import org.xml.sax.InputSource;

public class C4e_023a extends HttpServlet {
  public void service(HttpServletRequest request, HttpServletResponse response)
      throws ServletException, IOException {
    request.setCharacterEncoding("UTF-8");
    response.setContentType("text/html; charset=UTF-8");
    PrintWriter out = response.getWriter();
    try {
      DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
      factory.setFeature("http://apache.org/xml/features/disallow-doctype-decl", true);   // DTDを禁止する設定
      DocumentBuilder builder = factory.newDocumentBuilder();
      String xml =  request.getParameter("xml");
      Document doc = builder.parse(new InputSource(new StringReader(xml)));

      String name = doc.getElementsByTagName("name").item(0).getTextContent();
      String address = doc.getElementsByTagName("address").item(0).getTextContent();

      out.println("<body>以下の内容で登録しました<br>");
      out.println("氏名:" + StringEscapeUtils.escapeHtml4(name) + "<br>");
      out.println("住所:" + StringEscapeUtils.escapeHtml4(address) + "<br></body>");
    } catch (Exception e) {
      e.printStackTrace(out);
    }
  }
}
