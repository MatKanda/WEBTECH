function graph(){
        if (typeof (EventSource) !== "undefined") {

            let source = new EventSource("http://vmzakova.fei.stuba.sk/sse/sse.php");

            var sin = {
                x: [],
                y: [],
                name: 'Sin',
                type: 'scatter',
            };
            var cos = {
                x: [],
                y: [],
                name: 'Cos',
                type: 'scatter'
            };
            var data = [sin, cos];
            Plotly.newPlot('graph',data,{yaxis: {fixedrange: true}, xaxis : {fixedrange: true}},{displayModeBar: false});
            source.onmessage= function (e) {
                var data=JSON.parse(e.data);
                console.log(data.x+" "+data.y1+" "+data.y2);

                let amplitude=document.getElementById("rangeSlider").value;
                console.log("amplituda je "+amplitude);

                //enable zoom
                document.getElementById("stopButton").addEventListener("click", finish =() => {let layout = {
                    xaxis:{fixedrange:false},
                    yaxis:{fixedrange:false}
                };
                Plotly.relayout(document.getElementById("graph"),layout); source.close()});

                Plotly.extendTraces('graph', {
                    x:[[data.x],[data.x]],
                    y: [[amplitude*data.y1],[amplitude*data.y2]]},[0,1]);
            };


        } else {
            document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
        }
}

function visibleSin(){
    var sin = document.getElementById("visibleSin");
    if(sin.checked){
        Plotly.restyle(document.getElementById("graph"),{"visible":true},[0]);
    }
    else
        Plotly.restyle(document.getElementById("graph"),{"visible":false},[0]);
}

function visibleCos(){
    var cos = document.getElementById("visibleCos");
    if(cos.checked){
        Plotly.restyle(document.getElementById("graph"),{"visible":true},[1]);
    }
    else
        Plotly.restyle(document.getElementById("graph"),{"visible":false},[1]);
}


class MyComponent extends HTMLElement{
    constructor() {
        super();
    }
    connectedCallback() {
        this.style.width="20%";
        this.style.marginTop="1em";
        this.style.float="left";
    }

}

class MyComponent2 extends HTMLElement{
    constructor() {
        super();
    }
    connectedCallback() {
        this.style.width="80%";
        this.style.marginTop="1em";
        this.style.float="right";
    }

}

const template=document.createElement('template');
template.innerHTML= `
    <div>
        <input type="range" min="1" max="10" value="1" class="slider" id="rangeSlider" style="visibility: hidden" onchange="inputSlider()">
        <input style="margin-top: 1.5em;width: 9em; visibility: hidden" type="number" id="textValue" min="1" max="10" value="1" onchange="inputText()">

    </div>    
`;


class Amplitude extends HTMLElement{
    constructor() {
        super();
    }
    connectedCallback() {
        const temp=document.querySelector('template');
        this.appendChild(document.importNode(template.content,true));
    }
}


customElements.define('my-component', MyComponent);
customElements.define('my-component2', MyComponent2);
customElements.define('my-amplitude', Amplitude);

function inputSlider(){
    document.getElementById("textValue").value=document.getElementById("rangeSlider").value;
    document.getElementById("textValue").innerText=document.getElementById("rangeSlider").value;
}

function inputText(){
    document.getElementById("rangeSlider").value=document.getElementById("textValue").value;
    document.getElementById("rangeSlider").innerText=document.getElementById("textValue").value;
}

function options() {

    if (document.getElementById("slider").checked){
        document.getElementById("rangeSlider").style.visibility="visible";
    }
    else
        document.getElementById("rangeSlider").style.visibility="hidden";

    if (document.getElementById("text").checked){
        document.getElementById("textValue").style.visibility="visible";
    }
    else
        document.getElementById("textValue").style.visibility="hidden";

}
