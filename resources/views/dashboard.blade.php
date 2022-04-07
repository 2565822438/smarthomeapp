<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>智能家居控制系统</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/paho-mqtt.js" type="text/javascript"></script>
    <script src="js/mqtt.min.js" type="text/javascript"></script>
</head>


<body>
    <h1 class="text-primary align">智能家居控制系统</h1>
    <div class="align">
                @include('layouts.navigation')
            </div>
    <div class="align" >
    <iframe allowtransparency="true" frameborder="0" width="565" height="98" scrolling="no" src="//tianqi.2345.com/plugin/widget/index.htm?s=2&z=3&t=1&v=0&d=3&bd=0&k=&f=&ltf=009944&htf=cc0000&q=1&e=1&a=1&c=54511&w=565&h=98&align=center"></iframe>
    <div class="content">
        
        
        <div class="row">

            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <div class="home">
                    <img src="images/湿度.png" alt="湿度" />
                    <p>温度：</p>
                    <p id="temp">26℃</p>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <div class="home">
                    <img src="./images/温度.png" alt="温度" />
                    <p>湿度：</p>
                    <p id="humi">56%</p>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <div class="home">
                    <img src="./images/有害气体.png" alt="有害气体" />
                    <p>有害气体浓度：</p>
                    <p id="mq135">2.2</p>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <div class="home">
                    <img src="./images/灯开关.png" alt="灯" />
                    <p>灯: <p id="lamp1">开</p></p>
                    <input id="lamp" type="checkbox" class="switch_1">
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <div class="home">
                    <img src="./images/插座.png" alt="灯" />
                    <p>插座: <span id="RELAY1">开</span></p>

                    <input id="RELAY" type="checkbox" class="switch_1">

                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <div class="home">
                    <img src="./images/风扇.png" alt="灯" />
                    <p>风扇: <span>开</span></p>

                    <input type="checkbox" class="switch_1">

                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <div class="home">
                    <img src="./images/窗户-关.png" alt="灯" />
                    <p>窗户: <span>开</span></p>
                    <input type="checkbox" class="switch_1">
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <div class="home">
                    <img src="./images/门.png" alt="灯" />
                    <p>门: <span>开</span></p>
                    <input type="checkbox" class="switch_1">
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <div class="home">
                    <img src="./images/安防模式.png" alt="灯" />
                    <p>安防模式: <span>开</span></p>
                    <input type="checkbox" class="switch_1">
                </div>
            </div>
        </div>
    </div>













</body>
<script>
    //事件监听
    document.getElementById("lamp").addEventListener("click", displayDate1);
    document.getElementById("RELAY").addEventListener("click", displayDate2);
    //发送消息
    function displayDate1() {
        if (document.getElementById("lamp").checked) {
            client.publish('qing',"{ \"LED_SW\":0}");//开灯
        } else {
            client.publish('qing',"{ \"LED_SW\":1 }");//关灯
        }
    }
    function displayDate2() {
        if (document.getElementById("RELAY").checked) {
            client.publish('qing',"{\"RELAY\":0}");//开插座
        } else {
            client.publish('qing',"{\"RELAY\":1}");//插座
        }
    }



    
    
    // 
</script>

<script>
    var hostname = "152.32.170.86"
    var port = 8083
    var clientID = "qing";
    var topic = "qing";
    // 创建客户端实例
    client = new Paho.MQTT.Client(hostname, Number(port), clientID);

    // 设置回调处理程序
    client.onConnectionLost = onConnectionLost;
    client.onMessageArrived = onMessageArrived;

    // 连接客户端
    client.connect({
        onSuccess: onConnect,
        userName: "qing",
        password: "666666"
    });


    // 连接客户端时调用
    function onConnect() {
        // Once a connection has been made, make a subscription and send a message.
        console.log("onConnect");
        client.subscribe(topic);
        message = new Paho.MQTT.Message("Hello");
        message.destinationName = "World";
        client.send(message);
    }

    // 错误处理
    function onConnectionLost(responseObject) {
        if (responseObject.errorCode !== 0) {

            console.log("onConnectionLost:" + responseObject.errorMessage);
        }
    }

    // 接收消息
    function onMessageArrived(message) {
        console.log("接收的消息:" + message.payloadString);
        var obj = eval('(' + message.payloadString + ')');
        document.getElementById('temp').innerHTML = obj.temp;
        document.getElementById('humi').innerHTML = obj.humt;
        document.getElementById('mq135').innerHTML = obj.mq135;
        
        if (obj.LED_SW == 1) {
            document.getElementById("lamp").checked = false;
            document.getElementById('lamp1').innerHTML = "关";
            
        } else {
            document.getElementById("lamp").checked = true;
            document.getElementById('lamp1').innerHTML = "开";
        }
        if (obj.RELAY == 1) {
            document.getElementById("RELAY").checked = false;
            document.getElementById('RELAY1').innerHTML = "关";
            
        } else {
            document.getElementById("RELAY").checked = true;
            document.getElementById('RELAY1').innerHTML = "开";
        }

    }
</script>


</html>