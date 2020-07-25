import java.io.*;
import javax.servlet.http.*;
import org.apache.commons.lang3.StringEscapeUtils;

public class C4f_001 extends HttpServlet {
  String name; // インスタンス変数として宣言
  protected void doGet(HttpServletRequest req,
                       HttpServletResponse res)
       throws IOException {
    PrintWriter out = res.getWriter();
    out.print("<body>name=");
    try {
      name = req.getParameter("name"); // クエリストリングname
      Thread.sleep(3000); // 3秒待つ（時間のかかる処理のつもり）
      out.print(StringEscapeUtils.escapeHtml4(name)); // ユーザ名の表示
      // out.print(name); // ユーザ名の表示
    } catch (InterruptedException e) {
      out.println(e);
    }
    out.println("</body>");
    out.close();
  }
}
