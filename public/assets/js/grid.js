function coordinatesToGrid(x=0, y=0, type='both')
{
    x = x * 10;
    x = x + 117;
    y = y * 10;
    y = y - 617;
    y = y * -1;    
    if (type == 'x'){
        return x;
    } else if (type == 'y'){
        return y;
    } else if (type == "both") {
        return {"x": x, "y": y};
    } else {
        return false;
    }
}

function gridToCoordinates(x=0, y=0, type='both')
{
    x = x - 117;
    x = x / 10;
    y = y * -1;
    y = y + 617;
    y = y / 10;
    if (type == 'x'){
        return x;
    } else if (type == 'y'){
        return y;
    } else {
        return {"x": x, "y": y};
    }
}