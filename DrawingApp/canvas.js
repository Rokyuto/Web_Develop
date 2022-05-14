window.addEventListener("load", () => {
    const myCanvas = document.querySelector("#canvas"); // Get the Website canvas
    const ctx = myCanvas.getContext("2d"); // Get 2d Context of the myCanvas

    // Resize myCanvas
    f_resizeMyCanvas(myCanvas);

    // Variables
    let = isPainting = false; // Bool for is Painting

    function f_startPosition(e) {
        isPainting = true; // Start Painting
        f_draw(e); // Can Draw Dots
    }

    function f_endPosition() {
        isPainting = false; // Stop Painting
        ctx.beginPath(); // Will Create new Drawing Line on next MouseDown Event
    }

    // Function with event
    function f_draw(e) {
        if (!isPainting) { return } // It will not do anything
        ctx.lineWidth = 20; // Line width
        //Change Width
        ctx.lineCap = 'round'; // Line Circle Form

        // Draw Line
        ctx.lineTo(e.clientX, e.clientY) // Create Line on Client Mouse X and Y Positions
        ctx.stroke();
        ctx.BeginPath(); // Start drawing
        ctx.moveTo(e.clientX, e.clientY); // Draw Line following Client Mouse X and Y Positions
    }

    // EventListeners
    myCanvas.addEventListener("mousedown", f_startPosition) // On mouse Button Click
    myCanvas.addEventListener("mouseup", f_endPosition) // On mouse Button Released
    myCanvas.addEventListener("mousemove", f_draw) // On Mouse Button Click and Moved

});

function f_resizeMyCanvas(myCanvas) {
    myCanvas.width = window.innerWidth - 8;
    myCanvas.height = window.innerHeight - 100;
}
