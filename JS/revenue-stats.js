// Function to get the start and end dates of the current week
function getCurrentWeek() {
    const today = new Date();
    const dayOfWeek = today.getDay();
    const startOfWeek = new Date(today);
    const endOfWeek = new Date(today);

    // Adjust the start date to Sunday (0) and end date to Saturday (6)
    startOfWeek.setDate(today.getDate() - dayOfWeek); // Go back to Sunday
    startOfWeek.setHours(0, 0, 0, 0);  // Start at midnight
    startOfWeek.setDate(startOfWeek.getDate() + 1); // Move to the next day

    endOfWeek.setDate(today.getDate() + (6 - dayOfWeek)); // Go forward to Saturday
    endOfWeek.setHours(23, 59, 59, 999);  // End at 23:59:59
    endOfWeek.setDate(endOfWeek.getDate() + 1); // Move to the next day
    return { startDate: startOfWeek.toISOString().split('T')[0], endDate: endOfWeek.toISOString().split('T')[0] };
}

// Function to fetch and render the chart for the given week (start date and end date)
function fetchAndRenderWeekData(startDate, endDate) {
    fetch(`../PHP/stats-review.php?start_date=${startDate}&end_date=${endDate}`)
        .then(response => response.json())
        .then(data => {
            // Check if no data was returned
            if (data.length === 0) {
                // Display "No records yet" message
                document.getElementById('chart').innerHTML = '<center><p>No records yet.</p></center>';
            } else {
                document.getElementById('chart').innerHTML = '';
                // Prepare the data for the chart
                const salesData = data.map(item => ({
                    date: new Date(item.date),  // Convert date string to a JavaScript Date object
                    revenue: item.total_revenue  // Total revenue for the day
                }));

                // Re-render the chart with the new data
                updateChart(salesData);
            }
        })
        .catch(error => {
            console.error("Error fetching data:", error);
            // Display error message
            document.getElementById('chart').innerHTML = '<p>Failed to fetch data.</p>';
        });
}

// Function to update the chart with new data (after selecting a week)
function updateChart(salesData) {
    // Clear the existing chart content (if necessary)
    d3.select("#chart svg").remove();  // Remove old chart

    // Re-render the chart with the new data
    renderChart(salesData);
}

// Function to render the chart
function renderChart(salesData) {
    const container = document.getElementById('chart');
    const parentWidth = container.clientWidth;
    const parentHeight = container.clientHeight + (container.clientHeight * 0.1);

    const margin = { top: 20, right: 30, bottom: 60, left: 90 };  // Adjust margins as needed
    const chartWidth = (0.9 * parentWidth) - margin.left - margin.right;
    const chartHeight = (0.9 * parentHeight) - margin.top - margin.bottom;

    const svg = d3.select("#chart").append("svg")
        .attr("width", chartWidth + margin.left + margin.right)
        .attr("height", chartHeight + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    // Get the first date and ensure Day 1 is included in the xScale
    const firstDate = new Date(salesData[0].date);
    firstDate.setDate(firstDate.getDate() - 1);  // Shift back one day (to include Day 1)

    const xScale = d3.scaleTime()
        .domain([firstDate, d3.max(salesData, d => d.date)])  // Ensure Day 1 is included in the domain
        .range([0, chartWidth]);

    const yScale = d3.scaleLinear()
        .domain([0, d3.max(salesData, d => d.revenue)])  // Define y-scale based on revenue
        .range([chartHeight, 0]);

    const offSet = parentWidth * 0.05;
    const line = d3.line()
        .x(d => xScale(d.date) - offSet)  // Map dates to x positions
        .y(d => yScale(d.revenue));  // Map revenue to y positions

    // Append the line to the SVG
    svg.append("path")
        .data([salesData])
        .attr("class", "line")
        .attr("d", line)
        .attr("fill", "none")
        .attr("stroke", "#f95cba")
        .attr("stroke-width", 2);

    // Add the X axis (days) at the bottom with proper formatting
    svg.append("g")
        .attr("transform", "translate(0," + chartHeight + ")")
        .call(d3.axisBottom(xScale)
            .ticks(d3.timeDay.every(1))
            .tickFormat(d3.timeFormat("%d"))
            .tickSize(10))
        .selectAll("text")
        .style("text-anchor", "middle")
        .style("font-size", "12px");

    // Add the Y axis (revenue) on the left with Peso symbol
    svg.append("g")
        .call(d3.axisLeft(yScale).ticks(5).tickFormat(d => '₱' + d.toLocaleString()))
        .style("font-size", "12px");

    // Add labels for the axes
    svg.append("text")
        .attr("transform", "rotate(-90)")
        .attr("y", - 75)
        .attr("x", -chartHeight / 2)
        .attr("dy", "1em")
        .style("text-anchor", "middle")
        .attr("fill", "#9b1c97")
        .text("Revenue (₱)");

    svg.append("text")
        .attr("x", chartWidth / 2)
        .attr("y", chartHeight + margin.bottom - 10)
        .style("text-anchor", "middle")
        .attr("fill", "#9b1c97")
        .text("Days");
}

flatpickr("#week-select", {
    mode: "range",  // Allow users to select a date range
    dateFormat: "Y-m-d",  // Format the date (optional)
    onChange: function (selectedDates) {
        if (selectedDates.length === 2) {
            // Adjust the start date to the next day after the first selected date
            let startDate = new Date(selectedDates[0]);
            startDate.setDate(startDate.getDate() + 1);  // Move to the next day
            startDate = startDate.toISOString().split('T')[0]; // Format as YYYY-MM-DD

            let endDate = new Date(selectedDates[1]);
            endDate.setDate(endDate.getDate() + 1);  // Move to the next day
            endDate = endDate.toISOString().split('T')[0]; // Format as YYYY-MM-DD


            // Ensure the selection is exactly 7 days (7 days total, not 6)
            const diffInDays = (selectedDates[1] - selectedDates[0]) / (1000 * 3600 * 24); // Difference in days

            console.log("Start:", startDate, "End:", endDate, "Days Difference:", diffInDays); // Debug log

            if (diffInDays !== 6) {
                alert("Please select exactly 7 days (a full week).");
                this.clear();  // Clear selection if it's not a full week
            } else {
                // Send the adjusted start and end dates to the PHP script via GET request
                fetchAndRenderWeekData(startDate, endDate);
            }
        }
    },
    locale: {
        firstDayOfWeek: 0 // Set Sunday as the first day of the week
    }
});


// Fetch and render the current week's data by default on page load
const currentWeek = getCurrentWeek();
fetchAndRenderWeekData(currentWeek.startDate, currentWeek.endDate);

document.addEventListener("DOMContentLoaded", function () {
    const yearInput = document.getElementById("yearInput");
    const yearPickerPopup = document.getElementById("yearPickerPopup");
    const yearList = document.getElementById("yearList");

    // Populate years dynamically
    const startYear = 2024; // Starting year
    const endYear = 2050;   // Ending year

    for (let year = startYear; year <= endYear; year++) {
        const yearItem = document.createElement("div");
        yearItem.classList.add("year-item");
        yearItem.textContent = year;
        yearItem.addEventListener("click", function () {
            yearInput.value = year;
            yearPickerPopup.classList.remove("active");
            fetchAndUpdateTable(year);  // Fetch data when a year is selected
        });
        yearList.appendChild(yearItem);
    }

    // Show or hide the year picker popup
    yearInput.addEventListener("click", function () {
        yearPickerPopup.classList.toggle("active");
    });

    // Hide popup if clicked outside
    document.addEventListener("click", function (event) {
        if (!event.target.closest(".year-picker-container")) {
            yearPickerPopup.classList.remove("active");
        }
    });

    // Fetch and display current year's data by default
    const currentYear = new Date().getFullYear();
    yearInput.value = currentYear;  // Set the input to the current year
    fetchAndUpdateTable(currentYear);
});

// Set the year picker to the current year
const yearPicker = document.getElementById("yearInput");
const currentYear = new Date().getFullYear(); // Get the current year

// Set the input value to the current year
yearPicker.value = currentYear;

// Add event listener to the year picker
yearPicker.addEventListener("change", (event) => {
    const selectedYear = event.target.value;
    console.log("Year selected:", selectedYear);
    fetchAndUpdateTable(selectedYear); // Fetch data for the selected year
});

// Fetch initial data for the current year
fetchAndUpdateTable(currentYear);

// Function to fetch and update the table with data
function fetchAndUpdateTable(year) {
    fetch(`monthly-stats.php?year=${year}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const tableBody = document.querySelector("#revenueTable tbody");
            tableBody.innerHTML = ""; // Clear existing rows

            // Check if data is empty
            if (data.length === 0) {
                tableBody.innerHTML = "<tr><td colspan='3'>No data available for the selected year.</td></tr>";
                return;
            }

            data.forEach(row => {
                const tr = document.createElement("tr");

                // Handle growth percentage, ensuring it is properly formatted
                let growthPercentage = row.revenue_growth_percentage;
                if (growthPercentage === null || isNaN(growthPercentage)) {
                    growthPercentage = 'N/A'; // Set to 'N/A' if no growth data is available or it's not a number
                } else {
                    growthPercentage = `${parseFloat(growthPercentage).toFixed(2)}%`; // Ensure it's a number and format as percentage
                }

                tr.innerHTML = `
                    <td>${new Date(row.year, row.month - 1).toLocaleString('default', { month: 'long' })}</td>
                    <td>₱${parseFloat(row.total_revenue).toLocaleString()}</td>
                    <td>${growthPercentage}</td>
                `;
                tableBody.appendChild(tr);
            });

        })
        .catch(error => {
            console.error("Error fetching data:", error);
            const tableBody = document.querySelector("#revenueTable tbody");
            tableBody.innerHTML = "<tr><td colspan='3'>Error fetching data. Please try again later.</td></tr>";
        });
}

document.addEventListener("DOMContentLoaded", function () {
    const progressCircle = document.querySelector(".progress-circle");
    const progressText = document.querySelector(".progress-text");

    const totalRevenueElement = document.querySelector("#totalRevenue");
    const targetRevenueInput = document.querySelector("#targetRevenue");

    const dropdown = document.getElementById("monthDropdown");
    const monthName = document.getElementById("monthName");

    const monthNames = [
        "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
    ];

    // Populate the dropdown
    monthNames.forEach((month, index) => {
        const option = document.createElement("option");
        option.value = index + 1;
        option.textContent = month;
        dropdown.appendChild(option);
    });

    const currentMonth = new Date().getMonth();
    dropdown.value = currentMonth + 1; // Set dropdown to the current month
    monthName.value = monthNames[currentMonth]; // Set initial month name

    const radius = 70; // Circle radius
    const circumference = 2 * Math.PI * radius;

    // Set up the circle styles
    progressCircle.style.strokeDasharray = `${circumference}`;
    progressCircle.style.strokeDashoffset = `${circumference}`;

    let totalRevenue = 0; // This will be fetched dynamically from the backend

    // Function to fetch and update revenue based on the selected month
    function fetchAndUpdateRevenue() {
        const selectedMonth = dropdown.value; // Get the selected month (1-12)
        const targetRevenue = parseFloat(targetRevenueInput.value) || 0;

        // Update month name input field
        monthName.value = monthNames[selectedMonth - 1];

        // Fetch revenue data for the selected month
        fetch(`progress-revenue.php?month=${monthNames[selectedMonth - 1]}&year=${new Date().getFullYear()}`)
            .then(response => response.json())
            .then(data => {
                if (data && typeof data.total_revenue !== "undefined") {
                    totalRevenue = parseFloat(data.total_revenue) || 0;
                    totalRevenueElement.textContent = `₱${totalRevenue.toFixed(2)}`;
                    updateProgress(targetRevenue); // Update the progress bar with the new revenue
                } else {
                    console.error("Invalid data from PHP:", data);
                }
            })
            .catch(error => {
                console.error("Error fetching data from PHP:", error);
            });
    }

    // Function to update the progress bar
    function updateProgress(targetRevenue) {
        if (targetRevenue > 0) {
            // Calculate the progress percentage
            const progressPercentage = Math.min((totalRevenue / targetRevenue) * 100, 100); // Cap at 100%
            
            // Update the circle's stroke offset
            progressCircle.style.strokeDashoffset = `${circumference - (progressPercentage / 100) * circumference}`;

            // Update the text to show progress percentage
            progressText.textContent = `${progressPercentage.toFixed(2)}%`;
        } else {
            // Reset to 0 if no valid target revenue is entered
            progressCircle.style.strokeDashoffset = `${circumference}`;
            progressText.textContent = `0%`;
        }
    }

    // Listen for changes in the dropdown to update the revenue
    dropdown.addEventListener("change", fetchAndUpdateRevenue);

    // Listen for changes in the target revenue input
    targetRevenueInput.addEventListener("input", () => {
        const targetRevenue = parseFloat(targetRevenueInput.value) || 0;
        updateProgress(targetRevenue); // Update the progress based on the new target
    });

    // Initial fetch for the current month
    fetchAndUpdateRevenue();

    // Keep your original logic untouched
    // Select the SVG element
    const svg1 = document.querySelector(".progress-ring");
    const circ = document.querySelector(".progress-circle");

    // Get the actual rendered width and height using getBoundingClientRect
    const svg1Rect = svg1.getBoundingClientRect();
    const circRect = circ.getBoundingClientRect();
    const svg1Width = svg1Rect.width;
    const svg1Height = svg1Rect.height;
    const circWidth = circRect.width;
    const circHeight = circRect.height;

    // Calculate the center position (half of width and height)
    const centerX = svg1Width / 2;
    const centerY = svg1Height / 2;

    // Select the progress circle
    const progressCircle1 = svg1.querySelector(".progress-circle");
    const progressText1 = svg1.querySelector(".progress-text"); // Make sure the text is inside the SVG

    // Dynamically set the center of the circle based on the SVG's actual size
    progressCircle1.setAttribute("cx", centerX);
    progressCircle1.setAttribute("cy", centerY);
    progressCircle1.setAttribute("r", radius);

    // Center the text inside the circle
    progressText1.setAttribute("x", centerX); // Horizontally center the text
    progressText1.setAttribute("y", centerY); // Vertically center the text
    progressText1.setAttribute("text-anchor", "middle"); // Center align horizontally
    progressText1.setAttribute("dy", "0.35em"); // Vertically adjust the text to be in the center
});
