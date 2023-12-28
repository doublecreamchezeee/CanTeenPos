import axios from "axios";
import React, { Component } from "react";
import ReactDOM from "react-dom";
import { sum } from "lodash";

class Receipt extends Component {
    constructor(props) {
        super(props);
        this.route = document.getElementById('receipt').getAttribute('data-route');
        this.state = {
            receipt: [],
            products: [],
            barcode: "",
            search: '',
        };

        this.loadReceipt = this.loadReceipt.bind(this);
        this.handleOnChangeBarcode = this.handleOnChangeBarcode.bind(this);
        this.handleChangeQty = this.handleChangeQty.bind(this);
        this.handleScanBarcode = this.handleScanBarcode.bind(this);
        this.loadProducts = this.loadProducts.bind(this);
        this.addProductToCart = this.addProductToCart.bind(this);
        this.handleChangeSearch = this.handleChangeSearch.bind(this);
        this.handleSeach = this.handleSeach.bind(this);
        this.back = this.back.bind(this);
    }

    componentDidMount() {
        this.loadReceipt();
        this.loadProducts();
    }

    back(){
        window.location.href = this.route;
    }

    cancel(){
        axios
            .post("/admin/receipts/create/cart/delete/receipt", {
                _method: "DELETE",
            })
            .then((res) => {
                console.log('Delete successful: ', res.data);
                window.location.href = this.route;
            })
            .catch((e) => {
                console.error('Error cancel: ',e);
            })
    }

    handleCancelDetail(){
        console.log(this.state)
        axios
            .post("/admin/receipts/create/cart/delete/detail", {
                _method: "DELETE",
            })
            .then((res) => {
                console.log('Delete detail receipt successful: ', res.data);
                this.cancel()
            })
            .catch((e) => {
                console.error('Error cancel', e)
            })
    }

    handleScanBarcode(event) {
        event.preventDefault();
        const { barcode } = this.state;
        const { receipt } = this.state;
        // console.log("barcode: " + barcode);

        // console.log("From handleScanBarcode:\n", receipt);
        
        if (!!barcode){
            // console.log("Exist barcode in scanbar");
            if (receipt.length === 0){
                // console.log("DetailReceipt emty");
                axios
                    .post("/admin/receipts/create/cart",{
                        type: 0,
                        barcode,
                    })
                    .then((res) => {
                        console.log(res);
                        this.loadReceipt();
                        this.setState({ barcode: ""});
                    })
            //         .catch((err) => {
            //             console.log(err);
            //         });
            }
    
            else {
                // console.log("DetailReceipt exist");
                axios
                    .post("/admin/receipts/create/cart", {
                        barcode,
                        receiptID: receipt[0].pivot.receipt_id,
                        type: 1,
                    })
                    .then((res) => {
                        this.loadReceipt();
                        this.setState({ barcode: "" });
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        }
    }

    handleOnChangeBarcode(event) {
        const barcode = event.target.value;
        // console.log(barcode)
        this.setState({ barcode });
    }

    handleClickDelete(product_id) {
        const { receipt } = this.state;
        axios
            .post("/admin/receipts/create/cart/delete", {
                product_id,
                _method: "DELETE",
                receiptID: receipt[0].pivot.receipt_id,
            })
            .then((res) => {
                const receipt = this.state.receipt.filter(
                    (c) => c.id !== product_id
                );
                this.setState({ receipt });
            });
    }

    getTotal(receipt) {
        const total = receipt.map((c) => c.pivot.quantity * c.price);
        return sum(total).toFixed(2);
    }

    handleChangeQty(product_id, qty) {
        const receipt = this.state.receipt.map((c) => {
            if (c.id === product_id) {
                c.pivot.quantity = qty;
            }
            return c;
        });

        this.setState({ receipt });
        if (!qty) return;

        axios
            .post("/admin/receipts/create/cart/change-qty", {
                product_id,
                quantity: qty,
                receiptID: receipt[0].pivot.receipt_id,
            })
            .then((res) => {})
            .catch((err) => {
                console.log(err);
            });
    }

    handleChangeSearch(event) {
        const search = event.target.value;
        this.setState({ search });
    }

    handleSeach(event) {
        if (event.keyCode === 13) {
            this.loadProducts(event.target.value);
        }
    }

    loadProducts(search = '') {
        const query = !! search ? '?search=' + search : '';
        // console.log("query:",query)
        axios.get('/admin/products'+ query).then((res) => {
            const productData = res.data.data;

            const productsArray = Object.values(productData);

            this.setState({ products: productsArray }, () => {
                // console.log(this.state.products)
            });
        });
    }

    loadReceipt() {
        axios.get("/admin/receipts/create/cart").then((res) => {
            const receiptData = res.data;
            //   console.log("Receipt data" receiptData);

            const receiptArray = Object.values(receiptData);

            this.setState({ receipt: receiptArray }, () => {
                // console.log("Receipt: ",this.state.receipt);
            });
        });
    }

    addProductToCart(product,receipt) {
        console.log("AddCart-Product: ", this.state.products)
        console.log("AddCart-Barcode: ", product.barcode)
        console.log("AddCart-Receipt: ", receipt)

        let check_product = this.state.products.filter((p) => p.barcode === product.barcode);
        if (!!check_product) {
            // if product is already in cart
            console.log("check pro_id",product.id)
            let de_receipt = receipt.filter((c) => c.pivot.product_id === product.id);
            console.log("Check receipt in cart", de_receipt);
            if (!receipt) {
                console.log('go if')
                // update quantity
                this.setState({
                    receipt: this.state.receipt.map((c) => {
                        if (
                            c.pivot.product_id === product.id &&
                            product.quantity > c.pivot.quantity
                        ) {
                            c.pivot.quantity = c.pivot.quantity + 1;
                        }
                        return c;
                    }),
                });
            } else {
                console.log('go else')
                if (product.quantity > 0) {
                    product = {
                        ...product,
                        pivot: {
                            quantity: 1,
                            product_id: product.id,
                            receipt_id: receipt.id,
                        },
                    };

                    this.setState({ receipt: [...this.state.receipt, product] });
                }
            }
            axios
                .post("/admin/receipts/create/cart", { barcode: product.barcode,receiptID: this.state.receipt[0].pivot.receipt_id })
                .then((res) => {
                    this.loadReceipt();
                    console.log(res);
                })
                .catch((err) => {
                    // Swal.fire("Error!", err.response.data.message, "error");
                    console.log(err);
                });
        }
    }

    render() {
        const { receipt, barcode, products } = this.state;
        return (
            <div className="row">
            
                <div className="col-md-6 col-lg-4">
                    <div className="row">
                        <div className="col">
                            <form onSubmit={this.handleScanBarcode}>
                                <input
                                    type="text"
                                    className="form-control"
                                    placeholder="Scan Barcode..."
                                    value={barcode}
                                    onChange={this.handleOnChangeBarcode}
                                />
                            </form>
                        </div>
                        <div className="col">
                            <select name="" id="" className="form-control">
                                <option value="off">Offline Custumer</option>
                                <option value="on">Online Custumer</option>
                            </select>
                        </div>
                    </div>
                    <div className="card">
                        <table className="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th className="text-rigth">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                {receipt.map((c) => (
                                    <tr key={c.id}>
                                        <th>{c.name}</th>
                                        <th>
                                            <input
                                                type="text"
                                                className="form-control form-control-sm qty"
                                                value={c.pivot.quantity}
                                                onChange={(event) =>
                                                    this.handleChangeQty(
                                                        c.id,
                                                        event.target.value
                                                    )
                                                }
                                            />
                                            <button
                                                className="btn btn-danger btn-sm"
                                                onClick={() =>
                                                    this.handleClickDelete(c.id)
                                                }
                                            >
                                                <i className="fas fa-trash"></i>
                                            </button>
                                        </th>
                                        <th>{c.price * c.pivot.quantity}</th>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                    <div className="row">
                        <div className="col">Total: </div>
                        <div className="col text-right">
                            {this.getTotal(receipt)}
                        </div>
                    </div>

                    <div className="row">
                        <div className="col">
                            <button
                                type="button"
                                className="btn btn-danger btn-block"
                                onClick={() => 
                                    this.handleCancelDetail()
                                }
                            >
                                Cancel
                            </button>
                        </div>
                        <div className="col">
                            <button
                                type="button"
                                className="btn btn-primary btn-block"
                                onClick={() =>
                                    this.back()
                                }
                            >
                                Submit
                            </button>
                        </div>
                    </div>
                </div>

                <div className="col-md-6 col-lg-8">
                    <div>
                        <input
                            onChange={this.handleChangeSearch}
                            onKeyDown={this.handleSeach}
                            type="text"
                            className="form-control"
                            placeholder="Search Product ..."
                        />
                    </div>

                    <div className="order-product">
                        {products.map((p) => (
                            <div
                                onClick={() => this.addProductToCart(p,receipt)}
                                key={p.id}
                                className="item"
                            >
                                <img src={p.image_url}  alt="" />
                                <h5>
                                    {p.name}({p.quantity})
                                </h5>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        );
    }
}

export default Receipt;

if (document.getElementById("receipt")) {
    ReactDOM.render(<Receipt />, document.getElementById("receipt"));
}
