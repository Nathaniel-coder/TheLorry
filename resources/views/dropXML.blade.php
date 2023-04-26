<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <DropOff>
        <Tracking>{{ $XML->address1 ? 'PCu' : 'Drp' }}{{ date('mdy', strtotime($XML->created_at)) }}{{ $XML->id }}</Tracking>
        <From>
            <Date>{{ $XML->date }}</Date>
            <id>{{ $XML->id }}</id>
            <Name>{{ $XML->name}}</Name>
            <Phone>{{ $XML->phone }}</Phone>
            <Dropoff>{{ $XML->branch }}</Dropoff>
        </From>
        <To>
            <Name>{{ $XML->toname }}</Name>
            <Phone>{{ $XML->tophone }}</Phone>
            <Destination>{{ $XML->toaddress1 }},{{ $XML->address2 }},{{ $XML->topostcode }},{{ $XML->tocity }},{{ $XML->toprovince }},{{ $XML->tocountry }}</Destination>
        </To>
        <Driver>
            <Driver>{{ $XML->driverId ? $XML->driverId : 'Unassigned'  }}</Driver>
            <Vehicle>{{ $XML->vehicleId ? $XML->vehicleId : 'Unassigned'}}</Vehicle>
        </Driver>
        <Parcel>
            <Height>{{ $XML->height }}</Height>
            <Width>{{ $XML->width }}</Width>
            <Height>{{ $XML->length }}</Height>
            <Weight>{{ $XML->weight }}</Weight>
            <Price>{{ $XML->weight*4 }}</Price>
        </Parcel>
    </DropOff>
</urlset>
