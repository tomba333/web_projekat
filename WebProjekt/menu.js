

var title = 'React Developer';
var element = React.createElement(
    'h1',
    null,
    'Welcome, ',
    title
);

ReactDOM.render(element, document.getElementById('root'));

/*
class RentalHome extends React.Component{
    constructor(props){
        super(props);
        this.state = {
            rentals:[{
                _id: 1,
                title: "Nice Shahghouse Biryani",
                city: "Hyderabad",
                category: "condo",
                image: "http://via.placeholder.com/350x250",
                numOfRooms: 4,
                shared: true,
                description: "Very nice apartment in center of the city.",
                dailyPrice: 43
              },
              {
                _id: 2,
                title: "Modern apartment in center",
                city: "Bangalore",
                category: "apartment",
                image: "http://via.placeholder.com/350x250",
                numOfRooms: 1,
                shared: false,
                description: "Very nice apartment in center of the city.",
                dailyPrice: 11
              },
              {
                _id: 3,
                title: "Old house in nature",
                city: "Patna",
                category: "house",
                image: "http://via.placeholder.com/350x250",
                numOfRooms: 5,
                shared: true,
                description: "Very nice apartment in center of the city.",
                dailyPrice: 23
              }]
        }
    }
    render(){
        const {rentals} = this.state;
        return (
            <div className="card-list">
                <div className="container">
                    <h1 className="page-title">Your Home All Around the World</h1>
                    <div className="row">
                        {
                            rentals.map((rental)=>{
                                return(
                                    <div key={rental._id} className="col-md-3">
                                        <div className="card bwm-card">
                                        <img 
                                        className="card-img-top" 
                                        src={rental.image}
                                        alt={rental.title} />
                                        <div className="card-body">
                                        <h6 className="card-subtitle mb-0 text-muted">
                                            {rental.shared} {rental.category} {rental.city}
                                        </h6>
                                        <h5 className="card-title big-font">
                                            {rental.title}
                                        </h5>
                                        <p className="card-text">
                                            ${rental.dailyPrice} per Night &#183; Free Cancelation
                                        </p>
                                        </div>
                                        </div>
                                    </div>
                                )
                            })
                        }
                        
                    </div>
                </div>
            </div>
        )
    }
}
*/

/*
const domContainer = document.querySelector('#meni');
const root = ReactDOM.createRoot(domContainer);
root.render(e(LikeButton));
*/