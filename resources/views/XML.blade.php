<?php echo '<?data version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($data as $data)
        @if ($data->address1)
            <Pickup>
                <Tracking>
                    {{ $data->address1 ? 'PCu' : 'Drp' }}{{ date('mdy', strtotime($data->created_at)) }}{{ $data->id }}
                </Tracking>
                <From>
                    <Date>{{ $data->date }}</Date>
                    <id>{{ $data->id }}</id>
                    <Name>{{ $data->name }}</Name>
                    <Phone>{{ $data->phone }}</Phone>
                    <Address>
                        {{ $data->address1 }},{{ $data->address2 }},{{ $data->postcode }},{{ $data->city }},{{ $data->province }},{{ $data->country }}
                    </Address>
                </From>
                <To>
                    <Name>{{ $data->toname }}</Name>
                    <Phone>{{ $data->tophone }}</Phone>
                    <Destination>
                        {{ $data->toaddress1 }},{{ $data->address2 }},{{ $data->topostcode }},{{ $data->tocity }},{{ $data->toprovince }},{{ $data->tocountry }}
                    </Destination>
                </To>
                <Driver>
                    <Driver>{{ $data->driverId ? $data->driverId : 'Unassigned' }}</Driver>
                    <Vehicle>{{ $data->vehicleId ? $data->vehicleId : 'Unassigned' }}</Vehicle>
                </Driver>
                <Parcel>
                    <Height>{{ $data->height }}</Height>
                    <Width>{{ $data->width }}</Width>
                    <Height>{{ $data->length }}</Height>
                    <Weight>{{ $data->weight }}</Weight>
                    <Price>{{ $data->weight * 4 }}</Price>
                </Parcel>
            </Pickup>
        @endif
        @if (!$data->address1)
            <DropOff>
                <Tracking>
                    {{ $data->address1 ? 'PCu' : 'Drp' }}{{ date('mdy', strtotime($data->created_at)) }}{{ $data->id }}
                </Tracking>
                <From>
                    <Date>{{ $data->date }}</Date>
                    <id>{{ $data->id }}</id>
                    <Name>{{ $data->name }}</Name>
                    <Phone>{{ $data->phone }}</Phone>
                    <Dropoff>{{ $data->branch }}</Dropoff>
                </From>
                <To>
                    <Name>{{ $data->toname }}</Name>
                    <Phone>{{ $data->tophone }}</Phone>
                    <Destination>
                        {{ $data->toaddress1 }},{{ $data->address2 }},{{ $data->topostcode }},{{ $data->tocity }},{{ $data->toprovince }},{{ $data->tocountry }}
                    </Destination>
                </To>
                <Driver>
                    <Driver>{{ $data->driverId ? $data->driverId : 'Unassigned' }}</Driver>
                    <Vehicle>{{ $data->vehicleId ? $data->vehicleId : 'Unassigned' }}</Vehicle>
                </Driver>
                <Parcel>
                    <Height>{{ $data->height }}</Height>
                    <Width>{{ $data->width }}</Width>
                    <Height>{{ $data->length }}</Height>
                    <Weight>{{ $data->weight }}</Weight>
                    <Price>{{ $data->weight * 4 }}</Price>
                </Parcel>
            </DropOff>
        @endif
    @endforeach
</urlset>
