<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        
        <style>
            *{
                padding: 0;
                margin: 0;
                text-decoration: none;
                list-style: none;
            }
            body{
                font-family: montserrat;
            }

            nav{
                height: 80px;
                width: 100%;
                background: #2874a6;
            }
            label.logo{
                font-size: 35px;
                font-weight: bold;
                color: white;
                padding: 0 100px;
                line-height: 80px;
            }
            nav ul{
                float: right;
                margin-right: 40px;
                height: 40px;
            }
            nav li{
                display: inline-block;
                margin: 0 8px;
                line-height: 80px;
            }
            nav a{
                color: white;
                font-size: 18px;
                text-transform: uppercase;
                border: 1px solid transparent;
                padding: 7px 10px;
                border-radius: 3px;
            }
            a.active,a:hover{
                border: 1px solid white;
                transition: .5s
            }
            nav #icon{
                color: white;
                font-size: 30px;
                line-height: 80px;
                float: right;
                margin-right: 40px;
                cursor: pointer;
                display: none;
            }
            @media(max-width: 1048px){
                label.logo{
                    font-size: 32px;
                    padding-left: 60px;
                }
                nav ul{
                    margin-right: 20px;
                    margin-bottom: 0px
                }
                nav a{
                    font-size: 17px;
                }
            }
            @media(max-width: 909px){
                nav #icon{
                    display: block;    
                }
                nav ul{
                    position: fixed;
                    width: 100%;
                    height: 100vh;
                    background: #2f3640;
                    top: 80px;
                    left:-100%;
                    text-align:center;
                    transition: all .5s;
                }
                nav li{
                    display: block;
                    margin: 50px 0;
                    line-height: 30px;
                }
                nav a{
                    font-size: 20px;
                }
                a.active,a:hover{
                    border:none;
                    color: #3498db;
                }
                nav ul.show{
                    left: 0;
                }
            }
        </style>
    </head>

    <body>
        <nav>
            <label class="logo">Customer Support Desk</label>
            <ul>
                @guest
                <li><a class="active" href="/view_agent_login" style="text-decoration: none;">Agent Login</a></li>
                @endguest
                @auth 
                <li><a href="/agent_dashboard" style="text-decoration: none;">Dashboard</a></li>
                @endauth
                @auth 
                <li><a href="/logout" style="text-decoration: none;"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a></li>
                @endauth
            </ul>
            <label for="" id="icon">
                <i class="fas fa-bars"></i>
            </label>
        </nav>       
    </body>

</html>

<script>
    $(document).ready(function(){
        $('#icon').click(function(){
            $('ul').toggleClass('show');
        });
    });
</script>
