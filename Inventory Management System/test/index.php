<?php
// Include the database connection and session management
include('../config/database.php');
include('../config/on_session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table with Pagination, Warehouse Filter, and Live Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h4>Inventory Logs</h4>

        <!-- Warehouse Filter Dropdown -->
        <select class="form-select form-select-sm mb-3" id="warehouseFilter">
            <option selected value="">Select Warehouse</option>
            <?php echo implode("\n", $warehouse_options2); ?>
            <!-- Dynamically populate warehouse options here -->
        </select>

        <!-- Search Input -->
        <input id="search" class="form-control form-control-sm shadow-none" type="search" placeholder="Search..." aria-label="search" />

        <!-- Table -->
        <table class="table table-bordered" id="dataTable">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Warehouse</th>
                    <th>Supplier</th>
                </tr>
            </thead>
            <tbody>
                <!-- Table rows will be inserted here -->
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <div id="paginationControls">
            <button id="prevPageBtn" class="btn btn-primary">Previous</button>
            <span id="pageNumbers"></span>
            <button id="nextPageBtn" class="btn btn-primary">Next</button>
        </div>

        <!-- Results Info -->
        <p id="resultInfo"></p>
    </div>

    <script>
        let currentPage = 1;
        let totalPages = 1;
        let data = [];

        // Function to fetch and display data from the server
        // Function to fetch and display data from the server
function fetchData(page = 1, searchQuery = '') {
    currentPage = page;
    const warehouse = document.getElementById('warehouseFilter').value;

    // Fetch data with search query
    fetch(`table-content.php?page=${currentPage}&warehouse=${warehouse}`)
        .then(response => response.json())
        .then(responseData => {
            if (responseData.error) {
                console.error('Error:', responseData.error);
                return;
            }

            // Store the raw data for filtering
            data = responseData.data;

            // Normalize the search query (remove extra spaces and convert to lowercase)
            searchQuery = searchQuery.trim().toLowerCase();

            // Filter data based on the search query
            if (searchQuery) {
                data = data.filter(item => {
                    // Normalize the columns (remove extra spaces and convert to lowercase)
                    const fullname = item.fullname ? item.fullname.trim().toLowerCase() : '';
                    const warehouse_name = item.warehouse_name ? item.warehouse_name.trim().toLowerCase() : '';
                    const supplier_name = item.supplier_name ? item.supplier_name.trim().toLowerCase() : '';

                    // Check if any column contains the search query (as substring)
                    return (
                        fullname.includes(searchQuery) ||
                        warehouse_name.includes(searchQuery) ||
                        supplier_name.includes(searchQuery)
                    );
                });
            }

            // Populate the table with filtered data
            updateTable();
            
            // Update pagination
            totalPages = responseData.totalPages;
            updatePaginationControls();
            updateResultInfo(responseData.totalRecords);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}


        // Function to populate the table
        function updateTable() {
            const tableBody = document.querySelector('#dataTable tbody');
            tableBody.innerHTML = ''; // Clear the table body

            // Insert rows into the table
            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.fullname}</td>
                    <td>${item.warehouse_name}</td>
                    <td>${item.supplier_name}</td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Function to update pagination controls
        function updatePaginationControls() {
            const pageNumbers = document.getElementById('pageNumbers');
            pageNumbers.innerHTML = '';

            for (let i = 1; i <= totalPages; i++) {
                const pageBtn = document.createElement('button');
                pageBtn.className = 'btn btn-secondary mx-1';
                pageBtn.textContent = i;
                pageBtn.addEventListener('click', () => fetchData(i, document.getElementById('search').value));
                pageNumbers.appendChild(pageBtn);
            }

            // Enable/disable previous and next buttons
            document.getElementById('prevPageBtn').disabled = currentPage === 1;
            document.getElementById('nextPageBtn').disabled = currentPage === totalPages;
        }

        // Function to update result info
        function updateResultInfo(totalRecords) {
            const start = (currentPage - 1) * 10 + 1;
            const end = Math.min(currentPage * 10, totalRecords);
            document.getElementById('resultInfo').textContent = `${start}-${end} out of ${totalRecords} result(s)`;
        }

        // Event listener for warehouse filter
        document.getElementById('warehouseFilter').addEventListener('change', () => fetchData(1, document.getElementById('search').value));

        // Event listener for search input
        document.getElementById('search').addEventListener('input', (e) => {
            fetchData(1, e.target.value);
        });

        // Initial data load
        fetchData();
    </script>
</body>
</html>
