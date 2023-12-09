import axios from "axios";
import React, {Component} from "react";
import  ReactDOM  from "react-dom";
import {sum} from 'lodash'

class Receipt extends Component{

    constructor(props){
        super(props)
        this.state = {
            receipt: [],
            barcode: "",
        }

        this.loadReceipt = this.loadReceipt.bind(this)
        this.handleOnChangeBarcode = this.handleOnChangeBarcode.bind(this)
        this.handleChangeQty = this.handleChangeQty.bind(this)
        this.handleScanBarcode = this.handleScanBarcode.bind(this)
    }

    componentDidMount() {
        this.loadReceipt()
    }

    handleScanBarcode(event){
        event.preventDefault();
        const { barcode } = this.state;
        const { receipt } = this.state;
        console.log("barcode: " + barcode);
        if (!!barcode){
            console.log('Exist barcode in scanbar');
            axios
                .post('/admin/receipts/create',{barcode}, {receipt})
                .then(res =>{
                    this.loadReceipt();
                    this.setState({barcode: ""})
            })
            .catch((err) => {
                console.log(err);
            })
        }
    }

    handleOnChangeBarcode(event){
        const barcode = event.target.value;
        console.log(barcode)
        this.setState({barcode})
    }

    handleClickDelete(product_id) {
        axios
            .post('/admin/receipts/delete', {product_id, _method: 'DELETE'})
            .then(res => {
                const receipt = this.state.receipt.filter(c => c.id !== product_id);
                this.setState({receipt})
            });
    }

    getTotal(receipt){
        const total = receipt.map(c => c.pivot.quantity * c.price);
        return sum(total).toFixed(2);
    }

    handleChangeQty(product_id, qty){
        const receipt = this.state.receipt.map(c =>{
            if (c.id === product_id) {
                c.pivot.quantity = qty;
            }
            return c;
        });
        
        this.setState({receipt})
        if (!qty) return;

        axios
            .post('/admin/receipt/change-qty', {product_id, quantity: qty})
            .then((res) => {})
            .catch((err) => {
                console.log(err)
            })
    }

    loadReceipt() {
        axios.get('/admin/receipts/create').then((res) => {
          const receiptData = res.data;
        //   console.log(receiptData);
    
          const receiptArray = Object.values(receiptData);
    
          this.setState({ receipt: receiptArray }, () => {
            console.log(this.state.receipt);
          });
        });
      }

    render() {
        const {receipt, barcode} = this.state;
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
                                        onChange={event => this.handleChangeQty(c.id, event.target.value)}
                                    />
                                    <button className="btn btn-danger btn-sm" onClick={() => this.handleClickDelete(c.id)}>
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
                            <div className="col text-right">{this.getTotal(receipt)}</div>
                        </div>
        
                        <div className="row">
                            <div className="col">
                                <button type="button" className="btn btn-danger btn-block">Cancel</button>
                            </div>
                            <div className="col">
                                <button type="button" className="btn btn-primary btn-block">Submit</button>
                            </div>
        
                        </div>
                    </div>
        
                    <div className="col-md-6 col-lg-8">
                        <div>
                            <input type="text" className="form-control" placeholder="Search Product ..."/>
                        </div>
        
                        <div className="order-product">
                        </div>
                    </div>
                </div>
                
        )
    }
}

export default Receipt;

if (document.getElementById('receipt')) {
    ReactDOM.render(<Receipt />, document.getElementById('receipt'));
}
