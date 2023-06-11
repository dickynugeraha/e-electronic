<nav
    id="sidebarMenu"
    class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse"
>
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item nav-admin">
                <a class="nav-link" href="/admin/products">
                    <i class="fa fa-cubes me-1" aria-hidden="true"></i>
                    Products
                </a>
            </li>
            <li class="nav-item nav-admin">
                <div class="dropdown ms-3">
                    <p class="dropdown-toggle my-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-shopping-cart me-2" aria-hidden="true"></i> Orders
                    </p>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li><a class="dropdown-item" href="/orders/required_payment">Required Payment</a></li>
                      <li><a class="dropdown-item" href="/orders/checking">Checking</a></li>
                      <li><a class="dropdown-item" href="/orders/process">Process</a></li>
                      <li><a class="dropdown-item" href="/orders/on_shipping">On Shipping</a></li>
                      <li><a class="dropdown-item" href="/orders/success">Success</a></li>
                      <li><a class="dropdown-item" href="/orders/cancel">Cancel</a></li>
                    </ul>
                  </div>
            </li>
            <li class="nav-item nav-admin">
                <a class="nav-link" href="/admin/customers">
                    <i class="fa fa-users me-2" aria-hidden="true"></i>
                    Customers
                </a>
            </li>
            <li class="nav-item nav-admin">
                <a class="nav-link" href="/admin/shippings">
                    <i class="fa fa-truck me-2" aria-hidden="true"></i>
                    Shippings
                </a>
            </li>
    </div>
</nav>
