import Shepherd from "shepherd.js";
import "shepherd.js/dist/css/shepherd.css";

// Initialize Shepherd
const tour = new Shepherd.Tour({
    defaults: {
        classes: "shepherd-theme-arrows",
    },
});

// Add steps to the tour
tour.addStep("projects-menu-step", {
    title: "Projects Menu",
    text: "This is the Projects menu.",
    attachTo: { element: "#projects-menu-item", on: "right" },
    buttons: [
        {
            text: "Next",
            action: tour.next,
        },
    ],
});

tour.addStep("step-2", {
    text: "This is the second step!",
    attachTo: {
        element: ".step-2-element",
        on: "right",
    },
    buttons: [
        {
            text: "Back",
            action: tour.back,
        },
        {
            text: "Next",
            action: tour.next,
        },
    ],
});

tour.addStep("step-3", {
    text: "This is the third step!",
    attachTo: {
        element: ".step-3-element",
        on: "left",
    },
    buttons: [
        {
            text: "Back",
            action: tour.back,
        },
        {
            text: "Next",
            action: tour.next,
        },
    ],
});

tour.addStep("step-4", {
    text: "This is the fourth step!",
    attachTo: {
        element: ".step-4-element",
        on: "top",
    },
    buttons: [
        {
            text: "Back",
            action: tour.back,
        },
        {
            text: "Finish",
            action: tour.complete,
        },
    ],
});

// Start the tour
document.addEventListener("DOMContentLoaded", () => {
    tour.start();
});
