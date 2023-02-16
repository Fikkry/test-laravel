<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        body {
            background-color: #ededed;
        }

        .canvasMain {
            padding-left: 100px;
            width: 50%;
        }

        .sidenav {
            width: 100px;
            position: fixed;
            top: 40px;
            left: 3px;
        }

        .sidenav button {
            padding-top: 10px;
            margin-top: 10px;
            border: 1px solid #75E6DA;
            font-size: 20px;
            width: 100px;
            color: #189AB4;
            display: block;
        }

        .sidenav button:hover {
            color: #75E6DA;
        }
    </style>
</head>
<body>
    <div class="canvasMain">
        <p>Try Drawing below </p>
        
        <form id="form" action="" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-1">
                    <div class="sidenav">
                        <button type="button" class="tool" onclick="selectMode()">Select</button>
                        <button type="button" class="tool" onclick="drawMode()">Draw</button>
                        <button type="button" class="tool" onclick="createRectangle()">Rectangle</button>
                        <button type="button" class="tool" onclick="createCircle()">Circle</button>
                        <button type="button" class="tool" onclick="createTriangle()">Triangel</button>
                        <button type="button" class="tool" onclick="createTextbox()"> Text box</button>
                        <button type="button" class="tool" onclick="deleteObject()">Delete</button>
                        <button type="button" class="tool" onclick="undo()"> Undo</button>
                        <button type="button" class="tool" onclick="redo()"> Redo</button>
                        <button type="submit" class="tool"> Save Image</button>
                        <textarea class="form-control" id="canvas64" name="canvas" style="display: none"></textarea>
                    </div>
                </div>
                <div class="col-md-9">
                    <canvas id="demoCanvas"/>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.3.0/fabric.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script>
        const myCanvas = new fabric.Canvas("demoCanvas", {
            width: window.innerWidth - 200,
            height: window.innerHeight - 100,
            backgroundColor: "white",
            isDrawingMode: false,
        });

        const selectMode = () => {
            myCanvas.set({ isDrawingMode: false });
        };

        const drawMode = () => {
            myCanvas.set({ isDrawingMode: true });
        };

        const createRectangle = () => {
            const rectangle = new fabric.Rect({
                width: 100,
                height: 100,
                fill: 'white',
                stroke : 'black',
                strokeWidth : 1
            });
            myCanvas.add(rectangle)
            saveState()
        };

        const createTriangle = () => {
            const triangle = new fabric.Triangle({
                width: 100,
                height: 100,
                fill: 'white',
                stroke : 'black',
                strokeWidth : 1
            });
            myCanvas.add(triangle)
            saveState()
        };

        const createCircle = () => {
            const circle = new fabric.Circle({
                radius: 50,
                fill: 'white',
                stroke : 'black',
                strokeWidth : 1
            });
            myCanvas.add(circle)
            saveState()
        };

        const createTextbox = () => {
            const textbox = new fabric.Textbox("Text",{});
            myCanvas.add(textbox)
            saveState()
        };

        const deleteObject = () => {
            let activeObject = myCanvas.getActiveObjects();
            if(activeObject) { 
                myCanvas.discardActiveObject();
                myCanvas.remove(...activeObject);
                saveState()
            }
        }


        var states = [];
        var index = 0;

        myCanvas.on(
            'mouse:down', function () {
            saveState()
        },
            'object:rotating', function () {
            saveState()
        },
            'object:scaling', function () {
            saveState()
        },
            'object:selected', function () {
            saveState()
        },
            'object:modified', function () {
            saveState()
        },
            'object:removed', function () {
            saveState()
        },
            'object:added', function () {
            saveState()
        });

        const undo = () => {
            if (index > 0) {
                index--;
                myCanvas.clear();
                myCanvas.loadFromJSON(states[index]);
            }
        }

        const redo = () => {
            if (index < states.length - 1) {
                index++;
                myCanvas.clear();
                myCanvas.loadFromJSON(states[index]);
            }
        }

        function saveState() {
            index++;
            states.push(JSON.stringify(myCanvas));
        }

        window.addEventListener('keydown', (event) => {
            if (event.keyCode == 46 && event.code == "Delete") {
                let activeObject = myCanvas.getActiveObjects();
                if(activeObject) { 
                    myCanvas.discardActiveObject();
                    myCanvas.remove(...activeObject);
                    saveState()
                }
            }
        })

        document.addEventListener('keydown', function(event) {
            if(event.ctrlKey && event.keyCode === 90) {
                event.preventDefault();
                undo();
            } else if(event.ctrlKey && event.keyCode === 89) {
                event.preventDefault();
                redo();
            }
        });

        let form = document.getElementById('form')
        form.addEventListener('submit', function () {
            document.getElementById('canvas64').value = myCanvas.toDataURL("image/jpeg")
        })

        function setMaxStackSize(size) {
            undoStack = undoStack.slice(-size);
        }
    </script>
</body>
</html>
