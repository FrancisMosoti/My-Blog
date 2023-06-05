if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = time().'.'.$image->extension();

            $image->storeAs('uploads', $imageName);

            // You can store the image path in the database or perform any other necessary actions here
            User::update([
                'profile_image' => $imageName
            ]);