import Item from "./Item";

export default function Items({ items, users }) {

    return (
        <div>
            {items.map((item) => {
                const user = users.find(user => user.id === item.created_user_id);
                return <Item item={item} user={user} />
            })}
        </div>
    );
}
