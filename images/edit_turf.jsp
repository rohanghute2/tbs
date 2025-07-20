<%-- 
    Document   : edit_turf.jsp
    Created on : 25 Jun, 2023, 7:55:35 AM
    Author     : Bhaveshp
--%>
<%@ page import="java.sql.*" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ page import="javax.servlet.http.HttpSession" %>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/regi.css">
    <link rel="stylesheet" href="../css/login.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">

 <style>
        .form_container form {
                        margin-top: 50px;
                        border-radius: 11px;
                        width: 400px;
                        height: 406px;
                        padding: 40px;
                        padding-inline: 10px;
                        text-align: center;
                        background: rgba(205, 241, 215, 0.49);
                        }

                    * {
                        margin: 0;
                        padding: 0;
                        box-sizing: border-box;
                        font-family: 'Raleway', sans-serif;
                        color: rgb(73 194 49);
                        font-size: 15px;
                    }

                    .overs{
                        position: absolute;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    background-color: #0000003b;
                    z-index: -16;
                    }

                    .alert   { 
                        position: absolute;
                    top: 123px;
                    right: 91px;
                    /* left: 360px; */
                    background: aliceblue;
                    margin: auto;
                    border-radius: 13px;
                    height: 92px;
                    width: 315px;
                    box-shadow: 0px 0 27px 9px #0000003b;
                    animation-name: a;
                    animation-duration: 0.4s;
                    animation-iteration-count: 1;
                    transition: 0.5s ease-out;
                    }

                    @keyframes a {
                        0%{top: 160px;}
                        50%{top: 100px;}
                        100%{top: 123px}
                        
                    }
                    strong{
                        font-family: monospace;
                    display: flex;
                    margin: auto;
                    color: #000000b8;
                    height: 45px;
                    align-items: center;
                    justify-content: center;
                    font-size: 24px;
                    }
                    .alert_a{
                    text-decoration: none;
                        border: none;
                        font-size: 19px;
                    font-family: system-ui;
                    color: white;
                    font-weight: bold;
                    text-shadow: 0px 1px black;
                    display: flex;
                    margin: auto;
                    align-items: center;

                    justify-content: center;
                    height: 43px;
                    width: 72px;
                    border-radius: 8px;
                    background-color: #3d78ef;
                    transition: 0.3s ease-out;
                    }
                    .alert_a:hover{
                        box-shadow: 0 0 4px 1px #00000091;

                    }

                    div {
                        display: block;
                    }
 </style> 
 </head>

 <body>

    <body>
        <%!
            
        String url = "jdbc:mysql://localhost:3306/turfs";  // Update with your Oracle connection details
        String dbUsername = "root";
        String dbPassword = "";

        String email="";
        String pass="";
        String tname="";
        String add="";
        String sh_time="";
        String city="";
        float price=0;
        String username="";
        int count=0;
        boolean alert_s=false;
        Connection conn = null;
        PreparedStatement stmt = null,stmt1=null;
        ResultSet rs1=null;
    %>
        <%
        HttpSession sessio = request.getSession();
       
       email = (sessio != null) ? (String) sessio.getAttribute("OwnerLoggedIn") : null;
            try {

                // Connect to the database
                   Class.forName("com.mysql.jdbc.Driver");
                conn = DriverManager.getConnection(url, dbUsername, dbPassword);
                // Prepare the SQL statement
    

 
      String url = "jdbc:mysql://localhost:3306/turfs"; ;  
    String dbUsername = "root";
    String dbPassword = "";
    Connection conn = null;
    String user="";
    PreparedStatement stmt = null,stmt1=null;

    if (request.getMethod().equalsIgnoreCase("post"))
    {
        email=request.getParameter("email");
        pass=request.getParameter("pass");
        tname=request.getParameter("tname");
        add=request.getParameter("add");   
        sh_time=request.getParameter("sh_time");
        city=request.getParameter("city");
        price = Float.parseFloat(request.getParameter("price"));


                   Class.forName("com.mysql.jdbc.Driver");
                        conn = DriverManager.getConnection(url, dbUsername, dbPassword);
                
                
                    PreparedStatement stmt=conn.preparestatement("Update turfs set price=?, city=?, sh_time=?, add=?, tname=?, pass=? where email=? ");
                    stmt = conn.prepareStatement(sql);
                    stmt.setString(1,email);
                    stmt.setString(2,pass);
                    stmt.setString(3,tname);
                    stmt.setString(4,add);  
                    stmt.setString(5,sh_time); 
                    stmt.setString(6,city);
                    stmt.setFloat(7,price);
                    int i=stmt.executeUpdate();
                    //get data 
                    
                               if(i>0){
                            out.println("<div class='alert success'>");
                            out.println("<span class='closebtn'>&times;</span>");  
                            out.println("<strong> Congratulation ! </strong> You have Successfully Updated Details !!");
                            out.println("</div>");
                       }else{
                            out.println("<div class='alert warning'>");
                            out.println("<span class='closebtn'>&times;</span>");  
                            out.println("<strong> Please Check the details ! </strong> Something Went wrong !!");
                            out.println("</div>");
                    }
}

        }catch (Exception e) {
            out.println("An error occurred: " + e.getMessage());
        } finally {
            // Close database resources
            if (stmt != null) {
                stmt.close();
            }
            if (conn != null) {
                conn.close();
            }
        }
    
%>   
    

    <div class="header">
        <div class="left_header">
                <img src="../images/logo.png" alt="logo">
        </div>
        <div class="right_header">
                <div class="menu">
                    <li><a href="#Home">Home</a></li>
                    <li><a href="#Home">Turfs</a></li>
                    <li><a href="#Home">About</a></li>
                    <li><a href="#Home">Contact us</a></li>
                </div>

        </div>
    </div>


    <div class="form_container">
        <form  method="post" action="<%=request.getContextPath()%>/Owner/Add_turf.jsp"  >
                    
            <input type="text" name="email" class="field" value="" placeholder="Edit EmailID"><br>
            <input type="text" name="pass" class="field" value="" placeholder="Edit Password"><br>

            <input type="text" name="tname" class="field" value="" placeholder="Edit Turf Name"><br>            
            <input type="text" name="add" class="field" value="" placeholder="Edit Turf Address"><br>
            <input type="text" name="sh_time" class="field" value="" placeholder="Edit Shedule like 8am to 8pm "><br>
            
            <input type="text" name="city" class="field" value="" placeholder="Edit city "><br>
            <input type="text" name="price" class="field" value="" placeholder="Edit Price for per hour">
            <input type="submit" class="register" value="Update Turf" >
          
        </form>
   
    </div>
         
         <script type="text/javascript">
    var close = document.getElementsByClassName("closebtn");
    var i;
    for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
    }
    }
    </script>
</body>
</html>
