<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>智能家居控制系统</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <script src="./js/bootstrap.bundle.js"></script>
  </head>
  <style>
    .home {
      background-color: antiquewhite;
      border-radius: 10%;
      width: 200px;
      height: 200px;
      padding: 20px;
      margin: 20px;
    }
    .home img {
      width: 100px;
    }
    .home button {
      height: 30px;
      width: 60px;
      border-radius: 5%;
    }
  </style>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <div class="home">
      <img src="./images/湿度.png" alt="湿度" />
      <p>温度：</p>
      <p>26℃</p>
    </div>
    <div class="home">
      <img src="./images/温度.png" alt="温度" />
      <p>湿度：</p>
      <p>56%</p>
    </div>
    <div class="home">
      <img src="./images/有害气体.png" alt="有害气体" />
      <p>有害气体浓度：</p>
      <p>2.2</p>
    </div>
    <div class="home">
      <img src="./images/灯开关.png" alt="灯" />
      <p>灯: <span>开</span></p>
      <button></button>
    </div>
    <div class="home">
      <img src="./images/插座.png" alt="灯" />
      <p>插座: <span>开</span></p>
      <button></button>
    </div>
    <div class="home">
      <img src="./images/风扇.png" alt="灯" />
      <p>风扇: <span>开</span></p>
      <button></button>
    </div>
    <div class="home">
      <img src="./images/窗户-关.png" alt="灯" />
      <p>窗户: <span>开</span></p>
      <button></button>
    </div>
    <div class="home">
      <img src="./images/门.png" alt="灯" />
      <p>门: <span>开</span></p>
      <button></button>
    </div>
    <div class="home">
      <img src="./images/安防模式.png" alt="灯" />
      <p>安防模式: <span>开</span></p>
      <button></button>
    </div>
  </body>
    </body>
</html>
